    <div  style="dotted dashed solid double; background-color: yellow;">    
        <div>
            <input wire:model.lazy="xnewcat" class="w-half px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="New Category">
            <input wire:model.lazy="xnewsubcat" class="w-half px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="New SubCategory">
        </div>
        <div>
                    <select wire:model.lazy="xoldcat" class="w-half px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline">
                        <option value=""></option>
                    @foreach($xcat as $c)
                        @if(isset($selectedOldCat) && $selectedOldCat == $c->id)
                        <option value="{{$c->id}}" selected >{{$c->cat}}</option>
                        @else
                        <option value="{{$c->id}}" >{{$c->cat}}</option>
                        @endif
                    @endforeach
            <input wire:model.lazy="xoldsubcat" class="w-half px-5 py-3 border border-gray-400 rounded-lg outline-none focus:shadow-outline" type="text" placeholder="Name">
            <button wire:click="saveCat" id="saveCat" title = "Click to function" class="text-gray-900 cursor-pointer hover:bg-blue-200 focus:text-blue-700 focus:bg-blue-200 focus:outline-none focus:ring-blue-600" tabindex="1">
                Save
            </button>
        </div>
    </div>    
