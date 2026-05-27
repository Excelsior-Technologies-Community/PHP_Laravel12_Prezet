<?php

namespace App\Http\Controllers\Prezet;

use Illuminate\Http\Request;
use Illuminate\View\View;
use Prezet\Prezet\Data\DocumentData;
use Prezet\Prezet\Models\Document;
use Prezet\Prezet\Prezet;

class ShowController
{
    public function __invoke(Request $request, string $slug): View
    {
        $doc = Prezet::getDocumentModelFromSlug($slug);

        if (! $doc || empty($doc->filepath)) {
            abort(404, 'Document not found');
        }

        // NEW: increment views
        $doc->increment('views');

        $md = Prezet::getMarkdown($doc->filepath);

        $html = Prezet::parseMarkdown($md)
            ->getContent();

        $docData = Prezet::getDocumentDataFromFile(
            $doc->filepath
        );

        // RELATED POSTS
        $relatedPosts = Document::query()
            ->where('content_type', 'article')
            ->where('draft', false)
            ->where('category', $doc->category)
            ->where('id', '!=', $doc->id)
            ->limit(3)
            ->get();

        if ($docData->contentType === 'category') {

            $docs = Document::query()
                ->where('content_type', 'article')
                ->where('draft', false)
                ->where('category', $doc->category)
                ->orderBy('created_at', 'desc')
                ->get();

            $docsData = $docs->map(
                fn($doc) =>
                DocumentData::fromModel($doc)
            );

            return view('prezet.category', [
                'document' => $docData,
                'body' => $html,
                'docs' => $docsData,
            ]);
        }

        return view('prezet.show', [

            'document' => $docData,

            'body' => $html,

            'linkedData' => json_encode(
                Prezet::getLinkedData($docData)
            ),

            'headings' => Prezet::getHeadings(
                $html
            ),

            'author' => config(
                'prezet.authors.' .
                ($docData->frontmatter->author ?? null)
            ),

            'relatedPosts' => $relatedPosts,

            // NEW
            'views' => $doc->views
        ]);
    }
}   