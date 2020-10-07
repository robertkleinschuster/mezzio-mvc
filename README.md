# MVC for Mezzio Middleware

[![Build Status](https://travis-ci.com/robertkleinschuster/mvc.svg?branch=master)](https://travis-ci.com/robertkleinschuster/mvc)
[![Coverage Status](https://coveralls.io/repos/github/robertkleinschuster/mvc/badge.svg?branch=master)](https://coveralls.io/github/robertkleinschuster/mvc?branch=master)

This library provides MVC implementation for Mezzio Middleware.
This library is not affiliated with Mezzio or Laminas in any way.


## Installation

Run the following to install this library:

```bash
$ composer require robertkleinschuster/mvc
```

## Usage

Add a Route for the MvcHandler class.

```php
$app->any(MvcHandler::getRoute(), [MvcHandler::class], 'mvc');
```

Extend your `IndexController` class from `AbstractController` and 
implement yout first action `indexAction`.
For this action there has to be a template in the mvc template path 'index/index'.
See `Mvc\ConfigProvider` for configuration format.

```php
$this->setTemplateVariable('title', 'Hello world!');
```

## View

This Mvc also includes a view abstraction.
Assign a view object in your controller with:
```php
$this->setView(new View('Hello world!', new ViewModel()));
$this->getView()->setLayout('layout/dashboard');
$navigation = new Navigation('System');

$element = new Element(
            'Index',
            $this->getPathHelper()
                ->setController('index')
                ->setAction('index')
                ->getPath()
        );
$navigation->addElement($element);
$this->getView()->addNavigation($navigation);
```

Add components to your action:

```php
// Create a table component
$overview = new Overview();
$path = $this->getDetailPath();
// Add links column {id} is the placeholder for the "id" in your data, id is the name in the viewid paramter.
$path = $this->getPathHelper()->setViewIdMap(['id' => '{id}']);
$overview->addDetailIcon($path->setAction('detail')->getPath(false))->setWidth(122);
$overview->addEditIcon($path->setAction('edit')->getPath(false));
$overview->addDeleteIcon($path->setAction('delete')->getPath(false));
// Add a text column
$overview->addText('name', 'Name');
// Assign data list
$overview->getComponentModel()->setComponentDataBeanList($this->getModel()->getBeanList());
// Add component to view
$this->getView()->addComponent($overview);
```
Generate the data bean list in your model.

## Support

* [Issues](https://github.com/robertkleinschuster/mvc/issues/)
