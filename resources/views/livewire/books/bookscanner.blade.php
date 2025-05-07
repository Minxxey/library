<div class="bg-background text-lg">
    <form wire:submit.prevent="save" class="flex flex-col mt-5 gap-2 w-[90%] sm:w-[80%] md:w-[60%] mx-auto">
        <label for="">Buch nach ISBN suchen</label>
        <div class="flex flex-col gap-3 ">
            <input type="text" name="isbn" id="isbn" wire:model="isbn" class=" border-white border border-rounded">
            <button type="submit" class=" text-base bg-sky-300 text-cyan-900 rounded py-1 px-2 w-fit mx-auto">Buch suchen!</button>
        </div>
    </form>
    @if (session()->has('message'))
        <div
            x-data="{ show: true }"
            x-init="setTimeout(() => show = false, 3000)"
            x-show="show"
            class="mt-4 mx-auto text-green-600 bg-green-100 border border-green-300 p-2 rounded transition-opacity duration-500 w-75"
        >
            {{ session('message') }}
        </div>
    @endif

    @if($book)
        <div class="flex flex-col items-center book mx-auto w-[90%] sm:w-[80%] md:w-[60%] mt-6">
            <img class="mb-2" src="{{\Illuminate\Support\Facades\Storage::url($book->cover_img)}}" alt="">
            <p class="mb-2 pb-1 border-b-1 border-white">{{$book->title}}</p>
            <p class="mb-2 pb-1 border-b-1 border-white">{{$book->author}}</p>
            <p class="mb-2 pb-1 border-b-1 border-white">{{$book->published_year}}</p>
        </div>
    @endif
</div>
