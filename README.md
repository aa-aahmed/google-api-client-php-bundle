# google-api-client-php-bundle

Use the [Google APIs Client Library for PHP](https://github.com/google/google-api-php-client).

### Download the Bundle

```console
$ composer require samiaraboglu/google-api-client-php-bundle
```

### Enable the Bundle

Registered bundles in the `app/AppKernel.php` file of your project:

```php
<?php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            // ...
            new Samiax\GoogleApiBundle\SamiaxGoogleApiBundle(),
        );
        // ...
    }
    // ...
}
```

### Config
Add this to config.yml:

```yaml
samiax_google_api:
    credential_file:    "%kernel.root_dir%/config/google-api-client-php/client_credentials.json"
    application_name:   "APPLICATION_NAME"
    analytics_view_id:  "ANALYTICS_VIEW_ID"
    scopes:             ['https://www.googleapis.com/auth/analytics.readonly']
```

### Example
Get the session count from google analytics.

```php
$service = $this->get('samiax_google_api.google_client');

$viewId = $service->getConfig()->getAnalyticsViewId();
$analytics = $service->analytics();

// Create the DateRange object.
$dateRange = new \Google_Service_AnalyticsReporting_DateRange();
$dateRange->setStartDate("1daysAgo");
$dateRange->setEndDate("1daysAgo");

// Create the Metrics object.
$sessions = new \Google_Service_AnalyticsReporting_Metric();
$sessions->setExpression("ga:sessions");
$sessions->setAlias("sessions");

// Create the ReportRequest object.
$request = new \Google_Service_AnalyticsReporting_ReportRequest();
$request->setViewId($viewId);
$request->setDateRanges($dateRange);
$request->setMetrics([$sessions]);

$body = new \Google_Service_AnalyticsReporting_GetReportsRequest();
$body->setReportRequests([$request]);

echo $analytics->reports->batchGet($body)->getReports()[0]->getData()->getTotals()[0]->getValues()[0];
```
