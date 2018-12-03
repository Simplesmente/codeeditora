<?php

namespace CodeEduUser\Console;

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

use CodeEduUser\Repositories\PermissionRepository;
use CodeEduUser\Annotations\PermissionReader;

class CreatePermissionCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $name = 'codeeduuser:make-permission';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Criar permissão baseado em controllers e actions';

    private $repository;


    private $reader;

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(PermissionRepository $repository, PermissionReader $reader)
    {
        parent::__construct();

        $this->repository = $repository;
        $this->reader = $reader;
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function fire()
    {
        $permissions = $this->reader->getPermissions();

        foreach($permissions as $permission) {

            if(!$this->existsPermission($permission)){
                $this->repository->create($permission);
            }
        }
        
        $this->info("<info>Permissões Carregadas</info>");
    }

    private function existsPermission($permission) {
              
            $result = $this->repository->findWhere([
                'name' => $permission['name'],
                'resource_name' => $permission['resource_name']
            ])->first();
        
        return $result !== null;
    }
}
