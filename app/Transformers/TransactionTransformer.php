<?php

namespace App\Transformers;

use App\Transaction;
use League\Fractal\TransformerAbstract;

class TransactionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Transaction $transaction)
    {
        return [
            'id' => (int) $transaction->id,
            'quantity' => (string) $transaction->quantity,
            'buyer' => (string) $transaction->buyer_id,
            'product' => (int) $transaction->product_id,
            'creationDate' => (string)$transaction->created_at,
            'lastChange' => (string)$transaction->updated_at,
            'deletedDate' => isset($transaction->deleted_at) ? (string)$transaction->deleted_at : null
        ];
    }
}
