<x-layout>
@include('partials._hero')
@include('partials._search')
<div class="lg:grid lg:grid-cols-2 gap-4 space-y-4 md:space-y-0 mx-4">

    @unless (count($gigs) == 0)
        @foreach($gigs as $gig)
            <x-gig-card :gig="$gig" />
        @endforeach
    @else
        <p>No gigs found</p>
    @endunless
</div>

<div class="mt-6 p-4">
    {{ $gigs->links() }}
</div>
</x-layout>