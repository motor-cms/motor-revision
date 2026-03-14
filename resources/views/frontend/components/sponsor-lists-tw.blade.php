@foreach ($sponsors as $sponsor)
    <div class="flex flex-col md:flex-row items-start gap-4 mb-6">
        <div class="w-full md:w-[200px] md:shrink-0">
            <a href="{{$sponsor->url}}">
                <img src="{{$sponsor->file_associations()->where('identifier', 'logo_big')->first()->file->getFirstMedia('file')->getUrl('thumb')}}" alt="{{ $sponsor->name }} logo" class="w-full rounded-lg shadow">
            </a>
        </div>
        <div class="flex-1">
            <h4 class="flex justify-between items-center text-left">
                <span>{{$sponsor->name}}</span>
                <span class="inline-flex items-center rounded-full px-2.5 py-0.5 text-xs font-medium bg-accent/20 text-accent">{{trans('motor-revision::backend/sponsors.levels.'.$sponsor->level)}}</span>
            </h4>
            {!! $sponsor->text !!}
        </div>
    </div>
@endforeach
