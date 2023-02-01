
# TableInsights

TableInsights is a powerful package designed specifically for back-end developers using the Laravel framework. It allows for easy conversion of database tables into meaningful statistics and insights using just a model.


# Getting Started


Prerequisites

* Laravel Framework

## Installation

You can install the package via composer:

```bash
composer require ppranav/table-insights
```


You can load the package's config file by running:

```bash
php artisan vendor:publish --tag=tableinsights
```
The config file allows you to customize the tableinsights's settings.

You can customize the key names of your Tableinsights array and enable or disable individual keys to better suit your needs. To change a key name, enter/replace the desired key name in the right field.



# Usage

Extend the class \Ppranav\TableInsights\TableInsights in your own class and implement a models() method in the following code:


```bash
/**
 * Add arrays of models
 * @return array<Model, string>
 */
public function models() {
    return [
        Project::class => 'created_at',
        TaskLog::class => 'committed_at'
    ];
}

```


You may also update models query using the following code:



```bash
public function setQuery(Activity $activity)
{
    return $activity->query()->where(‘user_id’, auth()->id());
}

```


Finally, Your Implementation class should look like this:

```bash
class Dashboard extends TableInsights
{

    /**
     * Add arrays of models
     * @return array<Model, string>
     */
    public function models() {
        return [
            Project::class => 'created_at',
            TaskLog::class => 'committed_at'
        ];
    }

    public function setQuery(Activity $activity)
    {
        return $activity->query()->where('created_for_id', auth()->id());
    }
}

```


Show insights in a controller 

```bash
 return (new Dashboard())->getInsights();
```


## Screenshots

![App Screenshot](https://raw.githubusercontent.com/ppranav164/TableInsights/main/tableinsights.png)




## License

[MIT](https://choosealicense.com/licenses/mit/)

