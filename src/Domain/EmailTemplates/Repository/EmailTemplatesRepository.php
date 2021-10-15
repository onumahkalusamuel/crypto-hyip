<?php

namespace App\Domain\EmailTemplates\Repository;

use App\Base\Domain\Repository;

/**
 * Repository.
 */
class EmailTemplatesRepository extends Repository
{
    /**
     * @var PDO The database connection
     */
    protected $connection;
    protected $table = "email_templates";
    protected $properties = [
        'ID',
        'title',
        'subject',
        'content',
        'useGeneralHeader',
        'useGeneralFooter',
        'description'
    ]; 
}
