<?php

namespace App\Base;

use App\Database\SecondConnection;
use Psr\Container\ContainerInterface;

class Migration
{
    protected $container;
    protected $connection;
    protected $school_id;
    protected $migrations = [
        'Admin',
        '_Class',
        'ClassAllotment',
        'ExamPaper',
        'ExamRecord',
        'Grading',
        'GradingAllotment',
        'GradingItem',
        'Guardian',
        'Heading',
        'HeadingCategory',
        'HeadingClassAllotment',
        'HolidayProject',
        'House',
        'MenuAllotment',
        'PsychoMotor',
        'Question',
        'QuestionGroup',
        'Result',
        'ResultAnalysis',
        'Score',
        'ScoreSheet',
        'ScratchCard',
        'Settings',
        'Staff',
        'Student',
        'SubjectAllotment',
        'SubjectClassAllotment',
        'TeacherComment',
    ];

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
        $this->connection = $container->get(SecondConnection::class);
    }
    public function up($data)
    {

        if ($this->connection->getDriverName() === 'mysql') {
            
            foreach ($this->migrations as $migration) {
                $c = "\\App\\Migration\\" . $migration;
                if (class_exists($c)) {
                    $classInstance = new $c($this->connection);
                    if (method_exists($classInstance, 'down')) $classInstance->down();
                    if (method_exists($classInstance, 'up')) $classInstance->up();
                }
            }
        }

        $seedData = new \App\Migration\Seeds\SeedData($this->container);
        $seedData->up($data);


    }
}
