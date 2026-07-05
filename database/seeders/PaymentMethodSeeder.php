<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\PaymentMethod;
use App\Models\DestinationPaymentMethod;
use Illuminate\Database\Seeder;

class PaymentMethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Seed standard payment methods
        $methods = [
            [
                'name' => 'Entrada + Parcelas',
                'icon' => 'fa-solid fa-sack-dollar',
                'icon_color' => 'emerald',
            ],
            [
                'name' => 'À vista/parcelado',
                'icon' => 'fas fa-dollar-sign',
                'icon_color' => 'emerald',
            ],
            [
                'name' => 'Boleto',
                'icon' => 'fas fa-barcode',
                'icon_color' => 'blue',
            ],
            [
                'name' => 'Cartão de Crédito',
                'icon' => 'fas fa-credit-card',
                'icon_color' => 'blue',
            ],
        ];

        $seededMethods = [];
        foreach ($methods as $method) {
            $seededMethods[] = PaymentMethod::updateOrCreate(
                ['name' => $method['name']],
                $method
            );
        }

        // 2. Associate default values for all existing destinations
        $destinations = Destination::all();

        foreach ($destinations as $destination) {
            // Only seed if they don't have payment methods already
            if ($destination->paymentMethods()->count() === 0) {
                // Method 1: Entrada + Parcelas
                DestinationPaymentMethod::create([
                    'destination_id' => $destination->id,
                    'payment_method_id' => $seededMethods[0]->id,
                    'text' => 'Entrada de <strong>R$ 289,00</strong> + saldo devedor dividido em parcelas mensais até <strong>Março 2027</strong>.',
                    'subtext' => 'Pacote de Viagem tem que estar devidamente quitado até <strong>5 de Março 2027</strong>',
                    'order' => 1,
                ]);

                // Method 2: À vista/parcelado
                DestinationPaymentMethod::create([
                    'destination_id' => $destination->id,
                    'payment_method_id' => $seededMethods[1]->id,
                    'text' => 'À vista/parcelado (Depósito, Transferência, Promissória ou Pix)',
                    'subtext' => null,
                    'order' => 2,
                ]);

                // Method 3: Boleto
                DestinationPaymentMethod::create([
                    'destination_id' => $destination->id,
                    'payment_method_id' => $seededMethods[2]->id,
                    'text' => 'Boleto em até 9x com início de pagamento de Julho 2027',
                    'subtext' => null,
                    'order' => 3,
                ]);

                // Method 4: Cartão de Crédito
                DestinationPaymentMethod::create([
                    'destination_id' => $destination->id,
                    'payment_method_id' => $seededMethods[3]->id,
                    'text' => 'Cartão de crédito parcelado em até 10x',
                    'subtext' => '(Valor ajustado)',
                    'order' => 4,
                ]);
            }
        }
    }
}
