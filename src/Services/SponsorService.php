<?php

namespace Motor\Revision\Services;

use Motor\Backend\Services\BaseService;
use Motor\Media\Models\FileAssociation;
use Motor\Revision\Models\Sponsor;

/**
 * Class SponsorService
 *
 * @package Motor\Revision\Services
 */
class SponsorService extends BaseService
{
    protected $model = Sponsor::class;

    public function afterCreate()
    {
        $this->addFileAssociation('logo_big');
        $this->addFileAssociation('logo_small');
    }

    public function afterUpdate()
    {
        foreach ($this->record->file_associations()
                              ->get() as $fileAssociation) {
            if ($this->request->get($fileAssociation->identifier) != '' || $this->request->get($fileAssociation->identifier) == 'deleted') {
                $fileAssociation->delete();
            }
        }
        $this->afterCreate();
    }

    /**
     * @param $field
     */
    protected function addFileAssociation($field)
    {
        if ($this->request->get($field) == '' || $this->request->get($field) == 'deleted') {
            return;
        }

        $file = json_decode($this->request->get($field));

        // Create file association
        $fa = new FileAssociation();
        $fa->file_id = $file->id;
        $fa->model_type = get_class($this->record);
        $fa->model_id = $this->record->id;
        $fa->identifier = $field;
        $fa->save();
    }
}
