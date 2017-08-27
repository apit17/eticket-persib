@extends('backend.index')
@section('title', '| Edit Schedule')
@section('style')
<style type="text/css">

</style>
@stop
@section('content_menu')
<div class="span9">
    <div class="content">
        <div class="module">
            <div class="module-head">
                <h3>Add Kategori Ticket {{ $post->schedule_match }}</h3>
            </div>
            <div class="module-body">
                <div class="module-body">
                    <table class="table table-bordered" width="100%">
                        <thead>
                            <tr>
                                <th>Nama Kategori</th>
                                <th>Harga</th>
                                <th>Jumlah</th>
                            </tr>
                        </thead>
                        @if(count($post->tickets) != 0)
                            {{--*/ $data = collect($post->tickets)->sortByDesc('ticket_price')->all() /*--}}
                            @foreach($data as $value)
                                <tr>
                                    <td>{{ $value->ticket_name }}</td>
                                    <td>Rp. {{ number_format($value->ticket_price) }}</td>
                                    <td>{{ $value->ticket_stock }} Lbr.</td>
                                </tr>
                            @endforeach
                        @else
                        <tr>
                            <td colspan="4"><h3 style="text-align:-webkit-center;">Data Kosong</h3></td>
                        </tr>
                        @endif
                    </table>
                    <br>
                    <br>
                    <h3>
                        Tambah Data Tiket {{ $post->schedule_match }}
                    </h3>
                    <form method="POST" action="{{ route('admin.promotion.admin.add-ticket') }}" accept-charset="UTF-8" id="create-promotion" name="create-promotion" enctype="multipart/form-data" class="form-horizontal row-fluid">
                        <input type="hidden" name="id" value="{{ $post->id }}">
                        <div class="control-group">
                            <label class="control-label label" for="description">Nama Kategori: </label>
                            <div class="controls">
                                <input type="text" name="name" id="description" placeholder="Enter description, Ex: Tribun Timur" class="span10" required>
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label label" for="description">Harga: </label>
                            <div class="controls">
                                <input type="text" name="price" id="description" placeholder="Enter Price, Ex: 50000" class="span10" required maxlength="8">
                            </div>
                        </div>
                        <div class="control-group">
                            <label class="control-label label" for="description">Stock: </label>
                            <div class="controls">
                                <input type="number" name="stock" id="description" placeholder="Enter Stock, Ex: 1" class="span10" required maxlength="4">
                            </div>
                        </div>
                        <hr>
                        <button type="submit" class="btn btn-success">Submit</button>
                    </form>
                </div>
            </div>
        </div>   
    </div>
</div>
@stop

@section('script')
@stop