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
    // remove access to edit profile and/or view profile for contributor
    $user = \Drupal::currentUser();
    $config_factory = \Drupal::service('config.factory');
    $hide_view = $config_factory->get('as_user_options.settings')->get('hideviewprofile');
    $hide_edit = $config_factory->get('as_user_options.settings')->get('hideeditprofile');
    if (in_array('contributor', $user->getRoles())) {
      if ($route = $collection->get('user.page') && $hide_view) {
        $route->setRequirement('_access', 'FALSE');
      }
      if ($route = $collection->get('entity.user.edit_form') && $hide_edit) {
        $route->setRequirement('_access', 'FALSE');
      }
    }
  }

}