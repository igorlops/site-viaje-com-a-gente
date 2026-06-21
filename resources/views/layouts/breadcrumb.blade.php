    <section class="relative bg-[#001c3d] py-4 overflow-hidden">
        <div class="relative max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 z-10">
            <!-- Breadcrumbs -->
            <nav class="flex text-xs font-semibold uppercase tracking-wider text-gray-400">
                <a href="{{ route('home') }}" class="hover:text-[#f2bd11] transition duration-200">Início</a>
                @if(isset($breadcrumbs) && count($breadcrumbs) > 0)
                @foreach($breadcrumbs as $breadcrumb)
                @php
                    $link = $breadcrumb['link'];
                    $label = $breadcrumb['label'];
                @endphp
                    @if($loop->last)
                        <span class="mx-2 text-gray-600">/</span>
                        <span class="text-[#f2bd11]">{{ $label }}</span>
                    @else
                        <span class="mx-2 text-gray-600">/</span>
                        <a href="{{ $link }}" class="hover:text-[#f2bd11] transition duration-200">{{ $label }}</a>
                    @endif
                @endforeach
                @endif
            </nav>
        </div>
    </section>