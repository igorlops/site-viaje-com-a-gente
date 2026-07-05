<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DTOs\Admin\FaqDTO;
use App\Http\Requests\Admin\FaqRequest;
use App\Models\Faq;
use App\Repositories\FaqRepository;
use App\Services\Admin\FaqService;

class FaqController extends Controller
{
    public function __construct(
        protected FaqService $faqService,
        protected FaqRepository $faqRepository
    ) {}

    public function index()
    {
        $faqs = $this->faqRepository->all();
        return view('admin.faqs.index', compact('faqs'));
    }

    public function create()
    {
        return view('admin.faqs.create');
    }

    public function store(FaqRequest $request)
    {
        $dto = FaqDTO::fromRequest($request);
        $this->faqService->create($dto);

        return redirect()->route('admin.faqs.index')->with('success', 'Dúvida criada com sucesso!');
    }

    public function edit(Faq $faq)
    {
        return view('admin.faqs.edit', compact('faq'));
    }

    public function update(FaqRequest $request, Faq $faq)
    {
        $dto = FaqDTO::fromRequest($request);
        $this->faqService->update($faq->id, $dto);

        return redirect()->route('admin.faqs.index')->with('success', 'Dúvida atualizada com sucesso!');
    }

    public function destroy(Faq $faq)
    {
        $this->faqService->destroy($faq->id);
        return redirect()->route('admin.faqs.index')->with('success', 'Dúvida excluída com sucesso!');
    }
}
