<?php

namespace Database\Schema;

class DefaultFields
{
    public static function add(\Illuminate\Database\Schema\Blueprint &$table)
    {
        $table->timestamps();
        $table->uuid('created_by')->nullable();
        $table->uuid('updated_by')->nullable();
        $table->dateTime('deleted_at')->nullable();
        $table->uuid('deleted_by')->nullable();
        $table->index(['updated_at']);
        $table->primary('id');
    }
}
