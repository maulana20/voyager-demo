<?php

use Illuminate\Database\Seeder;

use TCG\Voyager\Models\DataType;
use TCG\Voyager\Models\DataRow;

use TCG\Voyager\Facades\Voyager;

use TCG\Voyager\Models\Menu;
use TCG\Voyager\Models\MenuItem;

use TCG\Voyager\Models\Permission;
use TCG\Voyager\Models\Role;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->addDataType();
        $this->addDataRow();
        
        $this->addMenuItem();
        
        $this->addPermission();
        
        // for ovveride model controller pada BREAD
        $this->updatePage();
    }
    
    public function addDataType()
    {
        $dataType = $this->dataType('slug', 'tags');
        if (!$dataType->exists) {
            $dataType->fill([
                'name'                  => 'tags',
                'display_name_singular' => 'Tag',
                'display_name_plural'   => 'Tags',
                'icon'                  => 'voyager-tag',
                'model_name'            => 'App\Tag',
                'policy_name'           => '',
                'controller'            => '',
                'generate_permissions'  => 1,
                'description'           => '',
            ])->save();
        }
    }
    
    public function addDataRow()
    {
        $dataType = DataType::where('slug', 'tags')->firstOrFail();
        
        $dataRow = $this->dataRow($dataType, 'id');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'number',
                'display_name' => 'ID',
                'required'     => 1,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 1,
            ])->save();
        }
        
        $dataRow = $this->dataRow($dataType, 'name');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'text',
                'display_name' => 'Name',
                'required'     => 1,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 1,
                'add'          => 1,
                'delete'       => 1,
                'order'        => 2,
            ])->save();
        }
        
        $dataRow = $this->dataRow($dataType, 'created_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Created At',
                'required'     => 0,
                'browse'       => 1,
                'read'         => 1,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 3,
            ])->save();
        }

        $dataRow = $this->dataRow($dataType, 'updated_at');
        if (!$dataRow->exists) {
            $dataRow->fill([
                'type'         => 'timestamp',
                'display_name' => 'Updated At',
                'required'     => 0,
                'browse'       => 0,
                'read'         => 0,
                'edit'         => 0,
                'add'          => 0,
                'delete'       => 0,
                'order'        => 4,
            ])->save();
        }
    }
    
    public function addMenuItem()
    {
        $menu = Menu::where('name', 'admin')->firstOrFail();
        
        $menuItem = MenuItem::firstOrNew([
            'menu_id' => $menu->id,
            'title'   => 'Tags',
            'url'     => '',
            'route'   => 'voyager.tags.index',
        ]);
        
        if (!$menuItem->exists) {
            $menuItem->fill([
                'target'     => '_self',
                'icon_class' => 'voyager-tag',
                'color'      => null,
                'parent_id'  => null,
                'order'      => 15,
            ])->save();
        }
    }
    
    public function addPermission()
    {
        Permission::generateFor('tags');
        
        $role = Role::where('name', 'admin')->firstOrFail();

        $permissions = Permission::all();

        $role->permissions()->sync(
            $permissions->pluck('id')->all()
        );
    }
    
    public function updatePage()
    {
        $table = Voyager::model('DataType')->whereName('pages')->first();
        $table->model_name = 'App\Page';
        $table->controller = '\App\Http\Controllers\VoyagerPagesController';
        $table->save();
    }
    
    protected function dataType($field, $for)
    {
        return DataType::firstOrNew([$field => $for]);
    }
    
    protected function dataRow($type, $field)
    {
        return DataRow::firstOrNew([
            'data_type_id' => $type->id,
            'field'        => $field,
        ]);
    }
}
