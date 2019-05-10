@extends('app')
@section('title', $collection->title. " · ".$collection->subtitle)

@section('page')
    <div id="emerge"></div>
@endsection 

@push('foot')
    <script type="text/javascript">
        window.emerge = {
            collection: {!!$collection->append('is_portal')!!},                        
        };
    </script>
    <script type="text/javascript" src="{{mix('js/emerge.js')}}"></script>
@endpush