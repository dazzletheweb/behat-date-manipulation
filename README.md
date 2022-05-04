# Behat Date Manipulation
This package allows you to execute a command that is time sensitive.

## When do I need this?
If you have time sensitive steps to execute, for example a cronjob
picks up items that are older than X days.

## Installation
Installation through composer:
```
composer require dazzle/behat-date-manipulation:dev-master
```
This package depends on [libfaketime](https://github.com/wolfcw/libfaketime.git).

Installation in most cases is as simple as:
```
git clone https://github.com/wolfcw/libfaketime.git
cd libfaketime && make install
```

## Usage
In your Behat config YAML file add following part in the 'Contexts':
```
- Dazzle\BehatDateManipulation\FeatureContext:
            parameters:
              install_path: "/usr/local/lib/faketime/libfaketime.so.1"
```
The default libfaketime path should normally be OK.

## Example steps:
```
Given I manipulate the date with "+30d" and execute command "php my_cron.php"

Given I manipulate the date with "-15d" and execute command "date"
And I save it into "DATE"
And I expect "<<DATE>>" to equal "xxxx"
```
The second example uses [rdx/behat-variables](https://github.com/rudiedirkx/behat-variables)
which is not included in this package but might be useful if you want to work with the output
that this package provides.

## Credits
- Originally developed by [Kevin Thiels](https://github.com/Novitsh)

[www.dazzle.be](https://www.dazzle.be/?ref=github-behat-date-manipulation)
[www.aperta.be](https://www.aperta.be/?ref=github-behat-date-manipulation)