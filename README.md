# TaskSchedulerBundle

PHP task scheduler/deferred task execution bundle for Symfony 3.3+

## Installation

### Install dependency into your project

Install with Composer:

```
$ composer require habuio/task-scheduler-bundle
```

### Enable bundle in your kernel

Open your `app/AppKernel.php` and add it:

```
    public function registerBundles()
    {
        $bundles = [
            [...]
            new Habu\TaskSchedulerBundle\TaskSchedulerBundle(),
        ];

        [...]

        return $bundles;
    }
```

## Usage

### Create task service class

Create a new file, for example `Task/MathTask.php`:

```
<?php

namespace AppBundle\Task;

use Habu\TaskSchedulerBundle\Task;

class MathTask extends Task
{
    public function add($a, $b)
    {
        return $a + $b;
    }
}
```

### Define Symfony service definition

Now, let's open your bundle's `services.yml` to define a service definition for our task:

```
services:
    # [...]
    app.tasks.math:
        class: AppBundle\Task\MathTask
        tags: ['task_scheduler.task']
```

Note the `task_scheduler.task` service tag - this enables the service to be executed inside our task worker

### Produce a task

Now that we have everything set up, let's delay execution of a task to a deferred task worker.

Why don't we do it in a Controller (`Controller/DefaultController.php):

```
<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $task = $this->get('app.tasks.math');

        // Defer execution of the task to a background worker.
        $ref = $task->add->delay(2, 2);

        // Halt execution of the application until the worker
        // finishes processing the task and yields the result.
        var_dump($ref->get()); exit;
    }
}
```

### Run the background worker job

TBD