AdminZone
---------

A powerful admin generator for Laravel.

## Getting started

```
    composer require incraigulous/adminzone
```

### publishing vendor resources

```
    php artisan vendor:publish --provider="Incraigulous\AdminZone\AdminZoneServiceProvider" --tag=config
```

**Available tags:** <br> 
`config`: publishes the config file to `config/adminzone.php`<br />
`assets`: publishes all assets including scss, js and views.<br />
`scss`: publishes scss to `vendor/adminzone/scss`<br />
`js`: publishes js to `vendor/adminzone/js`<br />
`views`: publishes views to `views/vendor/adminzone`<br />
`public`: publishes compiled assets to `public/vendor/adminzone`<br />

You can publish as much or as as you like. I recommended that you publish as little as possible to ensure comparability with future updates. Minor release should not introduce breaking changes, but If you choose to override views you should consider locking adminzone to the current release to ensure compatibility. 

### Creating your first resource

- Create a folder at `app/resources`
- Make a `app/resources/User.php` file that contains the `Example Resource` code below.
- Register your resource in `config.adminzone` by adding `\App\Resources\User::class` to the menu array.
- After you've created your resource, it will be available in the left sidebar of the admin. This is the minimum level of customization needed to add basic CRUD functionality for a model.

## Resources

#### Example resource

```php
    <?php
    namespace App\Resources;
    
    use Incraigulous\AdminZone\Resources\Resource;
    
    class User extends Resource
    {
        public function columns(): array
        {
            return [
                'ID' => 'id',
                'Name' => 'name',
                'email' => function ($user) {
                    return "<a href='mailto:$user->email' title='Email $user->name'>$user->email</a>";
                },
                'Created' => function($model) {
                    return $model->created_at->format('M d Y');
                },
            ];
        }
    
        public function fields(): array
        {
            return [
                'ID' => 'id',
                'Name' => 'name',
                'email' => function ($user) {
                    return "<a href='mailto:$user->email' title='Email $user->name'>$user->email</a>";
                }
            ];
        }
        
        public function model() {
            return new \App\User();
        }
    }
```

## Models

Any model managed by the Admin use use the `Incraigulous\AdminZone\Models\Traits\Administratable` trait or extend `Incraigulous\AdminZone\Models\Model`.



## Fields

Fields are objects that can be added to forms to build up a form view and specify how submissions should be handled. 

### Relationships 

Relationships user interfaces can easily be added through the use of relationship fields.

*Note: You must add an `order` int field to pivot tables to allow adminzone to control sort order.*

### Relationship Fieids

#### BelongsToField

The belongs to field adds a field to a form that handles a belongs to resource. It will generate a field that allows the user to select and edit the related resource.

```php
    protected function main(SectionInterface $main): SectionInterface
    {
        $main->field(TextField::create('Email'))
        ->$main->field(BelongsToField::create('User')->relatedTo(User::class));

        return $main;
    }
```

#### BelongsToManyField

The belongs to many field adds a field to a form that handles a belongs to many resources. It will generate a field that allows the user to select and edit the related resource.

```php
    protected function main(SectionInterface $main): SectionInterface
    {
        $main->field(TextField::create('Post Title'))
        $main->field(RichTextField::create('Content'))
        ->$main->field(BelongsToManyField::create('Author')->relatedTo(Author::class));

        return $main;
    }
```




