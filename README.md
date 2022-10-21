# Requirements

Moodle 3.9

# Installation

Follow the standard installation instructions: https://docs.moodle.org/39/en/Installing_plugins

# Usage

- Select this new plugin as the default Machine Learning Backend in **Site Admin > Analytics > Analytics Settings**
- Use the ML backend to perform evaluation, training...
- See the detailed evaluation metrics in **Site admin > Analytics > Analytics models**, clicking on the **Evaluation Log** for the predictive model you are evaluating

# Unit tests

Run unit tests for a Moodle plugin as per usual (https://docs.moodle.org/dev/PHPUnit)

```
vendor/bin/phpunit mlbackend_phpessec_metrics_testcase lib/mlbackend/phpessec/tests/metrics_test.php
```
