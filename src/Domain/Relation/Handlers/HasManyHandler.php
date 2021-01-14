<?php
namespace PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\Handlers;

class HasManyHandler implements RelationHandler
{
    private $updated = false;

    public function relation(): string
    {
        return 'Illuminate\Database\Eloquent\Relations\HasMany';
    }

    public function attach( $model, $relationship, $values): void
    {
        $dispatcher = $model->getEventDispatcher();

        $model->unsetEventDispatcher();



        $relationModel = $model->{$relationship}()->getModel();

        $models = $relationModel->find($values);

        $models->each(function ( $children ) use ( $model ){

            if(!$children->is($model))
            {
                if(!$model->ancestors->contains($children))
                {
                    $this->updated = true;

                    $children->parent()->associate($model);
                    $children->save();
                }
            }

        });



        foreach($model->{$relationship} as $children )
        {
            if(!$models->contains($children))
            {
                $this->updated = true;

                $children->parent()->dissociate();
                $children->save();
            }
        }



        if($this->updated)
        {
            $model->fixTree();
        }



        $model->setEventDispatcher($dispatcher);
    }

    public function retrieve($model, $relationship, $idKey)
    {
        return $model->{$relationship}->pluck($idKey)->all();
    }
}
