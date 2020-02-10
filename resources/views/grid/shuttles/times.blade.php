{{date('Y-m-d H:i', strtotime($record->departs_at)) }} ({{trans('motor-revision::backend/shuttles.departs_at')}})<br>
{{date('Y-m-d H:i', strtotime($record->arrives_at)) }} ({{trans('motor-revision::backend/shuttles.arrives_at')}})
