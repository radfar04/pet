<x-app-layout>
<section class="relative py-60 bg-white bg-gray-100 min-w-screen animation-fade animation-delay">
<form action="find">
    @include('wait')
        <div class="container h-full max-w-7xl mx-auto overflow-hidden rounded-lg shadow">
            <div> 
                {{{ Form::Label('cat', 'Category: ') }}}
                <select name="cats" id="cats">
                        <option value=""></option>
                @foreach($cats as $c)
                    @if(isset($selectedCat) && $selectedCat == $c->id)
                        <option value="{{$c->categories_id}}" selected >{{$c->cat}}</option>
                    @else
                        <option value="{{$c->categories_id}}" >{{$c->cat}}</option>
                    @endif
                @endforeach
                </select>
                @if($subcat)
                    {{{ Form::Label('subcat', 'SubCategory: ') }}}
                    <select name="subcat" id="subcat">
                                <option value=""></option>
                        @foreach($subcat as $c)
                            @if(isset($selectedSubCat) && $selectedSubCat == $c->id)
                                <option selected value="{{$c->sub_id}}">{{$c->subcat}}</option>
                            @else
                                <option value="{{$c->sub_id}}">{{$c->subcat}}</option>
                            @endif    
                        @endforeach
                    </select>
                @endif
                {{{ Form::Label('cat', 'Location: ') }}}
                <select name="locs" id="locs">
                        <option value=""></option>
                @foreach($locs as $c)
                        <option value="{{$c->location_id}}" >{{$c->l_description}}</option>
                @endforeach
                </select>
            </div>
            <div class="row">
              <label for="Created Date" class="col-sm-2 col-form-label">	From Date:</label>
              <div class="form-group col-md-4">
                <input type="text" class="form-control" name="cdate" id="cdate">
              </div>
            </div>
            <div class="row">
             <label for="Update Date"  class="col-sm-2 col-form-label">	To Date:</label>
             <div class="form-group col-md-4">
                <input type="text" class="form-control" name="udate" id="udate">
              </div>
            </div>            
            <div>
                {{{ Form::Label('desc', 'KeyWords: ') }}}
                {{{ Form::text('desc', '',["wire:model"=>"desc"]) }}}
            </div>
            <div class="pt-3">
                <button id="submit" type='submit' class="flex px-6 py-3 text-white bg-indigo-500 rounded-md hover:bg-indigo-600 hover:text-white focus:outline-none focus:shadow-outline focus:border-indigo-300" type="submit">
                    <span class="self-center float-left ml-3 text-base font-medium">Submit</span>
                </button>
            </div>
        </div>
</form>
    </section>  
</x-app-layout>
