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
```

### Example 1 - Google Analytics
Get the session count from google analytics.

```php
/**
 * @Route("/google/analytics", name="google_analytics")
 */
public function googleAnalyticsAction(Request $request)
{
    $service = $this->get('samiax_google_api.google_client');

    $googleClient = $service->getGoogleClient();
    $googleClient->setScopes(['https://www.googleapis.com/auth/analytics.readonly']);

    $analytics = $service->analytics();

    $viewId = "{VIEW_ID}";

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

    return new Response();
}
```

### Example 2 - Google Product Feed
Get the product feeds.

```php
/**
 * @Route("/google/content/auth", name="google_content_auth")
 */
public function googleContentAuthAction(Request $request)
{
    $service = $this->get('samiax_google_api.google_client');

    $googleClient = $service->getGoogleClient();
    $googleClient->setRedirectUri($request->getSchemeAndHttpHost() . $request->getBaseUrl() . $request->getPathInfo());
    $googleClient->setScopes('https://www.googleapis.com/auth/content');

    if ($request->query->get('code')) {
        $googleClient->authenticate($request->query->get('code'));

        $session = $this->container->get('session');
        $session->set('google_content_access_token', $googleClient->getAccessToken());

        return $this->redirect(filter_var($this->generateUrl('google_content'), FILTER_SANITIZE_URL));
    }

    return $this->redirect($googleClient->createAuthUrl());
}

/**
 * @Route("/google/content", name="google_content")
 */
public function googleContentAction()
{
    $session = $this->container->get('session');

    $accessToken = $session->get('google_content_access_token');

    if (!$accessToken) {
        return $this->redirect($this->generateUrl('google_content_auth'));
    }

    $service = $this->get('samiax_google_api.google_client');

    $googleClient = $service->getGoogleClient();
    $googleClient->setAccessToken($accessToken);

    $content = $service->shoppingContent();

    $merchantId = {MERCHANT_ID};

    $products = $content->products->listProducts($merchantId);

    var_dump($products);

    return new Response();
}
```
