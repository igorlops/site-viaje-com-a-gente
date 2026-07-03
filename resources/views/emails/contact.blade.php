<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novo Lead Recebido</title>
</head>
<body style="margin: 0; padding: 0; background-color: #f3f4f6; font-family: 'Helvetica Neue', Helvetica, Arial, sans-serif; -webkit-font-smoothing: antialiased; -moz-osx-font-smoothing: grayscale;">
    <table border="0" cellpadding="0" cellspacing="0" width="100%" style="background-color: #f3f4f6; padding: 40px 0;">
        <tr>
            <td align="center">
                <table border="0" cellpadding="0" cellspacing="0" width="600" style="background-color: #ffffff; border-radius: 16px; overflow: hidden; box-shadow: 0 4px 6px -1px rgba(0, 0, 0, 0.1), 0 2px 4px -1px rgba(0, 0, 0, 0.06);">
                    <!-- Header -->
                    <tr>
                        <td style="background: linear-gradient(135deg, #002752 0%, #001c3d 100%); padding: 30px; text-align: center;">
                            <h1 style="color: #ffffff; margin: 0; font-size: 20px; font-weight: 800; letter-spacing: 1px; text-transform: uppercase;">
                                Novo Lead Recebido
                            </h1>
                            <p style="color: #f3a908; margin: 5px 0 0 0; font-size: 13px; font-weight: 600;">
                                Viaje com a Gente - Canal de Vendas
                            </p>
                        </td>
                    </tr>
                    <!-- Content -->
                    <tr>
                        <td style="padding: 40px 30px;">
                            <p style="color: #374151; font-size: 15px; line-height: 1.5; margin: 0 0 25px 0;">
                                Olá, administrador! Você acabou de receber uma nova mensagem de contato enviada através do site. Veja os detalhes abaixo:
                            </p>

                            <table border="0" cellpadding="0" cellspacing="0" width="100%" style="margin-bottom: 25px;">
                                <tr>
                                    <td width="30%" style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        Nome
                                    </td>
                                    <td width="70%" style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #111827; font-size: 14px; font-weight: bold;">
                                        {{ $contact->name }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        E-mail
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #111827; font-size: 14px;">
                                        <a href="mailto:{{ $contact->email }}" style="color: #109e4a; text-decoration: underline; font-weight: bold;">
                                            {{ $contact->email }}
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        Telefone / WhatsApp
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #111827; font-size: 14px; font-family: monospace;">
                                        {{ $contact->phone ?? 'Não informado' }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        Origem / Canal
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #002752; font-size: 13px; font-weight: bold;">
                                        {{ $contact->type }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #6b7280; font-size: 12px; font-weight: bold; text-transform: uppercase;">
                                        Data de Envio
                                    </td>
                                    <td style="padding: 10px 0; border-bottom: 1px solid #e5e7eb; color: #4b5563; font-size: 13px;">
                                        {{ date('d/m/Y H:i') }}
                                    </td>
                                </tr>
                            </table>

                            <div style="background-color: #f9fafb; border: 1px solid #e5e7eb; border-radius: 8px; padding: 20px;">
                                <span style="display: block; color: #6b7280; font-size: 11px; font-weight: bold; text-transform: uppercase; margin-bottom: 8px;">
                                    Mensagem
                                </span>
                                <p style="color: #374151; font-size: 14px; line-height: 1.6; margin: 0; white-space: pre-wrap;">{{ $contact->message }}</p>
                            </div>
                        </td>
                    </tr>
                    <!-- Footer -->
                    <tr>
                        <td style="background-color: #f9fafb; padding: 25px 30px; border-top: 1px solid #e5e7eb; text-align: center;">
                            <p style="color: #9ca3af; font-size: 11px; margin: 0 0 5px 0;">
                                Este é um e-mail automático gerado pelo sistema. Por favor, não responda diretamente a este endereço.
                            </p>
                            <p style="color: #9ca3af; font-size: 11px; margin: 0;">
                                &copy; {{ date('Y') }} Viaje com a Gente. Todos os direitos reservados.
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
</body>
</html>
