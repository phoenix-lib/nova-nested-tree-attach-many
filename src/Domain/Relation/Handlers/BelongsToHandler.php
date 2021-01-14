<?php
namespace PhoenixLib\NovaNestedTreeAttachMany\Domain\Relation\Handlers;

use DomainException;

class BelongsToHandler implements RelationHandler
{
    public function relation(): string
    {
        return 'Illuminate\Database\Eloquent\Relations\BelongsTo';
    }

    public function attach( $model, $relationship, $value): void
    {
        if(is_array($value))
        {
            throw new DomainException('Can`t use BelongsTo relation with multiple select.');
        }

        if(intval($value) > 0)
        {
            $relationModel = $model->{$relationship}()->getModel();

            $model->{$relationship}()->associate($relationModel->find($value));
        }
        else
        {
            $model->{$relationship}()->dissociate();
        }

        $model->saveQuietly();
    }

    public function retrieve($model, $relationship, $idKey)
    {
        return $model->{$relationship} ? $model->{$relationship}->{$idKey}: null;
    }
}
