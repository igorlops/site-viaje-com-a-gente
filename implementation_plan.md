# Plano — Página de Detalhe do Destino (Pacote de Viagem)

## Objetivo
Criar uma página dinâmica de detalhe para cada destino, acessada ao clicar em um card na home, com layout fiel à imagem enviada. Toda a informação deve ser gerenciável pelo administrador.

---

## Seções da Página (baseadas na imagem)

| Seção | Origem dos dados |
|---|---|
| Banner hero (imagem + título + datas + preço) | `destinations` + novos campos |
| Barra de info rápida (saída, retorno, origem, tipo, duração) | `destinations` + novos campos |
| O que está incluso / Não incluso | nova tabela `destination_includes` |
| Cards de destaques (imagem, título, subtítulo, galeria) | nova tabela `destination_highlights` |
| Formas de pagamento (padrão, mas com o preço do pacote) | campo `price` + campos de parcelamento |
| Cronograma da viagem (Dia 1, Dia 2...) | nova tabela `destination_itinerary_days` |
| Atividades por dia (1 dia → N atividades) | nova tabela `destination_itinerary_activities` |

---

## Proposed Changes

### 1. Banco de Dados — Migrações

#### [MODIFY] destinations (nova migration de alteração)
Adicionar aos destinos já existentes:
- `slug` (único, para URL amigável: `/pacote/rio-de-janeiro-arraial-do-cabo`)
- `banner_image_path` (imagem de fundo do hero da página de detalhe)
- `full_price` (preço por pessoa, ex: R$ 3.499)
- `date_range` (ex: "17 a 21 de Março 2027")
- `nights` (ex: "5 dias / 4 noites")
- `departure_date` + `return_date` (texto, ex: "17 de Março 2027")
- `departure_city` (ex: "Fortaleza - CE")
- `trip_type` (ex: "Em grupo")
- `highlights_icons` (JSON com ícones: avião, hotel, café, etc.)

#### [NEW] `destination_includes`
Itens inclusos **e** não inclusos no pacote:
- `id`, `destination_id` (FK), `text` (string), `type` (`included` | `not_included`), `order`, `timestamps`

#### [NEW] `destination_highlights`
Cards com imagem + título + subtítulo (galeria clicável):
- `id`, `destination_id` (FK), `title`, `subtitle` (nullable), `image_path`, `order`, `timestamps`

#### [NEW] `destination_itinerary_days`
Um registro por dia do roteiro:
- `id`, `destination_id` (FK), `day_number` (int), `date` (string, ex: "17 de Março 2027"), `label` (ex: "Dia 1"), `order`, `timestamps`

#### [NEW] `destination_itinerary_activities`
Atividades dentro de cada dia (1-para-N):
- `id`, `itinerary_day_id` (FK), `activity` (string), `order`, `timestamps`

---

### 2. Models

#### [MODIFY] [Destination.php](file:///e:/Programacao/site-viaje-com-a-gente/app/Models/Destination.php)
Adicionar relações: `includes()`, `highlights()`, `itineraryDays()`. Adicionar `slug` no fillable, e usar `HasFactory`.

#### [NEW] `DestinationInclude.php` — fillable: `destination_id`, `text`, `type`, `order`
#### [NEW] `DestinationHighlight.php` — fillable: `destination_id`, `title`, `subtitle`, `image_path`, `order`
#### [NEW] `DestinationItineraryDay.php` — fillable: `destination_id`, `day_number`, `date`, `label`, `order`
#### [NEW] `DestinationItineraryActivity.php` — fillable: `itinerary_day_id`, `activity`, `order`

---

### 3. Controllers

#### [MODIFY] [SiteController.php](file:///e:/Programacao/site-viaje-com-a-gente/app/Http/Controllers/SiteController.php)
Adicionar método `destinationShow($slug)` que:
1. Busca o destino pelo `slug` com todos os relacionamentos eager-loaded
2. Busca os `socialLinks` (para header/footer)
3. Retorna a view `destination.show`

#### [MODIFY] [AdminController.php](file:///e:/Programacao/site-viaje-com-a-gente/app/Http/Controllers/AdminController.php)
Expandir o formulário de criação/edição de destinos para suportar os sub-recursos:
- Campos de detalhe (slug, preço completo, datas, banner, ícones)
- CRUD inline de "Inclusos/Não Inclusos"
- CRUD inline de "Destaques" (com upload de imagens)
- CRUD de dias do roteiro e atividades via formulários aninhados

---

### 4. Routes

#### [MODIFY] [web.php](file:///e:/Programacao/site-viaje-com-a-gente/routes/web.php)
Adicionar rota pública `/pacote/{slug}` e rotas CRUD admin para sub-recursos.

---

### 5. Views

#### [NEW] `resources/views/destination/show.blade.php`
Página pública completa seguindo o layout da imagem.

#### [MODIFY] `resources/views/admin/destinations/edit.blade.php` + `create.blade.php`
Expandir com seções para dados de detalhe, inclusos, destaques e cronograma.

---

## Verificação

- `php artisan migrate` para as novas tabelas
- Acessar `/pacote/porto-de-galinhas` e confirmar layout
- Admin: criar um destino completo com itinerário, inclusos e highlights
- Cards da home redirecionam para `/pacote/{slug}`

> [!IMPORTANT]
> As cards na home page serão atualizadas para redirecionar para `/pacote/{slug}` em vez de apenas ao WhatsApp.

> [!NOTE]
> A migração das novas colunas na tabela `destinations` usará `Schema::table()` (alteração, não recriação), preservando os dados já inseridos pelo seeder.
