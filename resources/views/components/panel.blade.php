@props(['title'])
<section {{ $attributes->merge(['class' => 'overflow-hidden rounded-xl border border-slate-200 bg-white shadow-sm']) }}>
    <h2 class="border-b border-slate-100 px-6 py-5 text-lg font-semibold">{{ $title }}</h2>
    {{ $slot }}
</section>
