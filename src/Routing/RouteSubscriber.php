<?php
namespace Drupal\as_user_options\Routing;

use Drupal\Core\Routing\RouteSubscriberBase;
use Symfony\Component\Routing\RouteCollection;

/**
 * Listens to the dynamic route events.
 */
class RouteSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
   if ($route = $collection->get('entity.user.edit_form')) {
      $route->setRequirement('_access', 'FALSE');
    }

    if ($route = $collection->get('user.page')) {
      $route->setRequirement('_access', 'FALSE');
    }
  }

}