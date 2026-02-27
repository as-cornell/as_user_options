[![Latest Stable Version](https://poser.pugx.org/as-cornell/as_user_options/v)](https://packagist.org/packages/as-cornell/as_user_options)
# AS USER OPTIONS (as_user_options)

## INTRODUCTION

Provides fine-grained control over links in user toolbar and other user-related configurations.

- remove access to edit profile and view profile for specific roles
- Hide user tab for all roles, if checked
- Hide 'Shortcuts' for all roles, if checked
- Hide 'Manage' for users who are faculty, student, or staff who are not also editor or contributor
- Hide 'View profile' for all roles, if checked
- Hide 'Edit profile' for all roles, if checked

### Technical Approach

This module uses Drupal's alter hooks to modify the toolbar and user menu before they are rendered. For toolbar items (Shortcuts, Manage), the module uses `hook_toolbar_alter()` to completely remove items from the render array using `unset()`, ensuring they are not rendered at all rather than just hidden with CSS. For user profile links (View profile, Edit profile), the module uses `hook_preprocess_links__toolbar_user()` to remove specific links from the user menu. User login tabs are controlled via `hook_menu_local_tasks_alter()` which sets `#access` to FALSE for tab items. All configurations are stored in Drupal's configuration system and can be managed through the admin interface.

## CONFIGURATION
- Enable the module as you would any other module
- Configure the global module settings: /admin/config/people/as-user-options-settings

## MAINTAINERS

Current maintainers for Drupal 10:

- Mark Wilson (markewilson)
