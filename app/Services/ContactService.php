<?php

namespace App\Services;

use App\DTOs\ContactDTO;
use App\Repositories\ContactRepository;
use App\Models\SiteSetting;
use App\Mail\ContactMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class ContactService
{
    public function __construct(
        protected ContactRepository $repository
    ) {}

    /**
     * Handle the contact form submission.
     */
    public function handle(ContactDTO $dto): void
    {
        // Execute repository storage logic
        $this->repository->store($dto);

        // Dispara a notificação por e-mail
        try {
            // Busca o e-mail configurado em Configurações Gerais
            $emailSite = SiteSetting::where('key', 'contact_email')->value('value');
            
            // Fallback caso não esteja configurado
            if (empty($emailSite)) {
                $emailSite = config('mail.from.address', 'hello@example.com');
            }

            Mail::to($emailSite)->send(new ContactMail($dto));
        } catch (\Exception $e) {
            // Registra no log caso ocorra falha de rede/SMTP, sem quebrar o fluxo para o cliente
            Log::error('Erro ao enviar e-mail de contato: ' . $e->getMessage(), [
                'dto' => $dto->toArray(),
                'trace' => $e->getTraceAsString()
            ]);
        }
    }
}
