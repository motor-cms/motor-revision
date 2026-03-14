@foreach ($sponsors as $sponsor)
    <div class="flex items-start gap-4 mb-6">
        <div class="w-[200px] shrink-0">
            <a href="{{$sponsor->url}}">
                <img src="{{$sponsor->file_associations()->where('identifier', 'logo_big')->first()->file->getFirstMedia('file')->getUrl('thumb')}}" class="w-full rounded-lg shadow">
            </a>
        </div>
        <div class="flex-1">
            <h4 class="flex justify-between items-center text-left">
                <span>{{$sponsor->name}}</span>
                <span>{{trans('motor-revision::backend/sponsors.levels.'.$sponsor->level)}}</span>
            </h4>
            {!! $sponsor->text !!}
        </div>
    </div>
@endforeach
