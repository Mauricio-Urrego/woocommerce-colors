<?php

/**
 * @file
 * Contains \MauricioUrrego\GlassesForWooCommerce\Admin.
 */

namespace Mauriciourrego\GlassesForWooCommerce;

/**
 * Administrative back-end functionality.
 */
class Admin {

  public static function admin_init() {
    add_action('admin_enqueue_scripts', __CLASS__ . '::enqueue_admin_assets');
    if (!class_exists('WooCommerce')) {
      add_action('admin_notices', __NAMESPACE__ . '\Admin::enable_woocommerce');
    }
  }

  /**
   * Get the plugin url.
   *
   * @return string
   */
  public static function plugin_url() {
    return untrailingslashit( plugins_url( '/', GLASSES_PLUGIN_FILE ) );
  }

  public static function add_glasses_menu_page() {
    add_menu_page(
      'Glasses for WooCommerce',
      'Glasses',
      'manage_options',
      'glasses',
      __CLASS__ . '::glasses_settings_page',
      'data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9Im5vIj8+CjwhRE9DVFlQRSBzdmcgUFVCTElDICItLy9XM0MvL0RURCBTVkcgMS4xLy9FTiIgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCIKWwo8IUFUVExJU1QgZwogIHhtbG5zOnZlY3Rvcm5hdG9yIENEQVRBICNGSVhFRCAiaHR0cDovL3ZlY3Rvcm5hdG9yLmlvIgogIHZlY3Rvcm5hdG9yOmxheWVyTmFtZSBDREFUQSAjSU1QTElFRCA+CjwhQVRUTElTVCBnCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6bWFzayBDREFUQSAjSU1QTElFRCA+CjwhQVRUTElTVCB0ZXh0CiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6d2lkdGggQ0RBVEEgI0lNUExJRUQgPgoKPCFBVFRMSVNUIHBhdGgKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpibGVuZE1vZGUgQ0RBVEEgI0lNUExJRUQgPgo8IUFUVExJU1QgcGF0aAogIHhtbG5zOnZlY3Rvcm5hdG9yIENEQVRBICNGSVhFRCAiaHR0cDovL3ZlY3Rvcm5hdG9yLmlvIgogIHZlY3Rvcm5hdG9yOnNoYWRvd0NvbG9yIENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIHBhdGgKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpzaGFkb3dPcGFjaXR5IENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIHBhdGgKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpzaGFkb3dSYWRpdXMgQ0RBVEEgI0lNUExJRUQgPgo8IUFUVExJU1QgcGF0aAogIHhtbG5zOnZlY3Rvcm5hdG9yIENEQVRBICNGSVhFRCAiaHR0cDovL3ZlY3Rvcm5hdG9yLmlvIgogIHZlY3Rvcm5hdG9yOnNoYWRvd09mZnNldCBDREFUQSAjSU1QTElFRCA+CjwhQVRUTElTVCBwYXRoCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6c2hhZG93QW5nbGUgQ0RBVEEgI0lNUExJRUQgPgoKPCFBVFRMSVNUIGltYWdlCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6YmxlbmRNb2RlIENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIGltYWdlCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6c2hhZG93Q29sb3IgQ0RBVEEgI0lNUExJRUQgPgo8IUFUVExJU1QgaW1hZ2UKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpzaGFkb3dPcGFjaXR5IENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIGltYWdlCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6c2hhZG93UmFkaXVzIENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIGltYWdlCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6c2hhZG93T2Zmc2V0IENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIGltYWdlCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6c2hhZG93QW5nbGUgQ0RBVEEgI0lNUExJRUQgPgoKPCFBVFRMSVNUIGcKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpibGVuZE1vZGUgQ0RBVEEgI0lNUExJRUQgPgo8IUFUVExJU1QgZwogIHhtbG5zOnZlY3Rvcm5hdG9yIENEQVRBICNGSVhFRCAiaHR0cDovL3ZlY3Rvcm5hdG9yLmlvIgogIHZlY3Rvcm5hdG9yOnNoYWRvd0NvbG9yIENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIGcKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpzaGFkb3dPcGFjaXR5IENEQVRBICNJTVBMSUVEID4KPCFBVFRMSVNUIGcKICB4bWxuczp2ZWN0b3JuYXRvciBDREFUQSAjRklYRUQgImh0dHA6Ly92ZWN0b3JuYXRvci5pbyIKICB2ZWN0b3JuYXRvcjpzaGFkb3dSYWRpdXMgQ0RBVEEgI0lNUExJRUQgPgo8IUFUVExJU1QgZwogIHhtbG5zOnZlY3Rvcm5hdG9yIENEQVRBICNGSVhFRCAiaHR0cDovL3ZlY3Rvcm5hdG9yLmlvIgogIHZlY3Rvcm5hdG9yOnNoYWRvd09mZnNldCBDREFUQSAjSU1QTElFRCA+CjwhQVRUTElTVCBnCiAgeG1sbnM6dmVjdG9ybmF0b3IgQ0RBVEEgI0ZJWEVEICJodHRwOi8vdmVjdG9ybmF0b3IuaW8iCiAgdmVjdG9ybmF0b3I6c2hhZG93QW5nbGUgQ0RBVEEgI0lNUExJRUQgPgoKPCFFTlRJVFkgJSBTVkcuZmlsdGVyLmV4dHJhLmNvbnRlbnQgICJ8IGZlRHJvcFNoYWRvdyIgPgo8IUVMRU1FTlQgZmVEcm9wU2hhZG93IEVNUFRZPgo8IUFUVExJU1QgZmVEcm9wU2hhZG93CiAgeG1sbnM6c3ZnIENEQVRBICNGSVhFRCAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIgogIGR4IENEQVRBICNJTVBMSUVEPgo8IUFUVExJU1QgZmVEcm9wU2hhZG93CiAgeG1sbnM6c3ZnIENEQVRBICNGSVhFRCAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIgogIGR5IENEQVRBICNJTVBMSUVEPgo8IUFUVExJU1QgZmVEcm9wU2hhZG93CiAgeG1sbnM6c3ZnIENEQVRBICNGSVhFRCAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIgogIHN0ZERldmlhdGlvbiBDREFUQSAjSU1QTElFRD4KPCFBVFRMSVNUIGZlRHJvcFNoYWRvdwogIHhtbG5zOnN2ZyBDREFUQSAjRklYRUQgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCIKICBmbG9vZC1vcGFjaXR5IENEQVRBICNJTVBMSUVEPgo8IUFUVExJU1QgZmVEcm9wU2hhZG93CiAgeG1sbnM6c3ZnIENEQVRBICNGSVhFRCAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIgogIGluIENEQVRBICNJTVBMSUVEPgo8IUFUVExJU1QgZmVEcm9wU2hhZG93CiAgeG1sbnM6c3ZnIENEQVRBICNGSVhFRCAiaHR0cDovL3d3dy53My5vcmcvR3JhcGhpY3MvU1ZHLzEuMS9EVEQvc3ZnMTEuZHRkIgogIHJlc3VsdCBDREFUQSAjSU1QTElFRD4KPCFBVFRMSVNUIGZlRHJvcFNoYWRvdwogIHhtbG5zOnN2ZyBDREFUQSAjRklYRUQgImh0dHA6Ly93d3cudzMub3JnL0dyYXBoaWNzL1NWRy8xLjEvRFREL3N2ZzExLmR0ZCIKICBmbG9vZC1jb2xvciBDREFUQSAjSU1QTElFRD4KXQo+CjwhLS0gQ3JlYXRlZCB3aXRoIFZlY3Rvcm5hdG9yIChodHRwOi8vdmVjdG9ybmF0b3IuaW8vKSAtLT4KPHN2ZyBoZWlnaHQ9IjEwMCUiIHN0cm9rZS1taXRlcmxpbWl0PSIxMCIgc3R5bGU9ImZpbGwtcnVsZTpub256ZXJvO2NsaXAtcnVsZTpldmVub2RkO3N0cm9rZS1saW5lY2FwOnJvdW5kO3N0cm9rZS1saW5lam9pbjpyb3VuZDsiIHZlcnNpb249IjEuMSIgdmlld0JveD0iMCAwIDUxMiA1MTIiIHdpZHRoPSIxMDAlIiB4bWw6c3BhY2U9InByZXNlcnZlIiB4bWxucz0iaHR0cDovL3d3dy53My5vcmcvMjAwMC9zdmciIHhtbG5zOnZlY3Rvcm5hdG9yPSJodHRwOi8vdmVjdG9ybmF0b3IuaW8iIHhtbG5zOnhsaW5rPSJodHRwOi8vd3d3LnczLm9yZy8xOTk5L3hsaW5rIj4KPGRlZnMvPgo8ZyBpZD0iVW50aXRsZWQiIHZlY3Rvcm5hdG9yOmxheWVyTmFtZT0iVW50aXRsZWQiPgo8cGF0aCBkPSJNNDkzLjIzNCAyMzguODE5TDQ4Ni4xNzkgMjM4LjgxOUM0ODIuNDI1IDIxNC44MTEgNDcxLjA0NiAxOTIuNzM4IDQ1My43NTIgMTc2LjAxMkM0MzQuMDY4IDE1Ny4xMjQgNDA4LjQ2NyAxNDYuNjU2IDM4MS42MTQgMTQ2LjY1NkMzNTguMjg5IDE0Ni42NTYgMzM2LjEwMiAxNTQuMjggMzE3LjY2OSAxNjguNzNDMzAxLjk2OCAxODEuMDE4IDI5MC4xMzQgMTk3LjI4OSAyODIuOTY2IDIxNi4xNzdDMjc1LjAwMSAyMTAuOTQzIDI2NS40NDQgMjA3Ljg3MSAyNTYgMjA3Ljg3MUMyNDYuNTU2IDIwNy44NzEgMjM2Ljk5OSAyMTAuODI5IDIyOS4wMzQgMjE2LjE3N0MyMjEuOTc5IDE5Ny4yODkgMjEwLjE0NiAxODEuMDE4IDE5NC4zMzEgMTY4LjczQzE3NS44OTggMTU0LjI4IDE1My43MTEgMTQ2LjY1NiAxMzAuMzg2IDE0Ni42NTZDMTAzLjUzMyAxNDYuNjU2IDc3LjkzMjUgMTU3LjAxIDU4LjI0ODMgMTc1Ljc4NEM0MC45NTM2IDE5Mi43MzggMjkuNTc1NSAyMTQuOTI1IDI1LjgyMDcgMjM4LjkzM0wxOC43NjYzIDIzOC45MzNDOS42NjM3NyAyMzguOTMzIDIuMjY3OTkgMjQ2LjU1NiAyLjI2Nzk5IDI1NkMyLjI2Nzk5IDI2NS40NDQgOS42NjM3NyAyNzMuMDY3IDE4Ljc2NjMgMjczLjA2N0wyNS44MjA3IDI3My4wNjdDMjkuNTc1NSAyOTcuMTg5IDQwLjk1MzYgMzE5LjI2MiA1OC4yNDgzIDMzNS45ODhDNzcuOTMyNSAzNTQuODc2IDEwMy41MzMgMzY1LjM0NCAxMzAuMzg2IDM2NS4zNDRDMTg4Ljc1NSAzNjUuMzQ0IDIzNi4zMTYgMzE2LjQxOCAyMzYuMzE2IDI1Ni4yMjhMMjM2LjMxNiAyNTZDMjM2LjMxNiAyNDkuMjg3IDI0NC4xNjcgMjM5LjA0NyAyNTYgMjM5LjA0N0MyNjcuODMzIDIzOS4wNDcgMjc1LjY4NCAyNDkuMjg3IDI3NS42ODQgMjU2TDI3NS42ODQgMjU2LjExNEMyNzUuNjg0IDMxNi4zMDQgMzIzLjI0NSAzNjUuMjMgMzgxLjYxNCAzNjUuMjNDNDA4LjU4MSAzNjUuMjMgNDM0LjE4MSAzNTQuODc2IDQ1My43NTIgMzM1Ljg3NEM0NzEuMDQ2IDMxOS4xNDkgNDgyLjQyNSAyOTYuOTYxIDQ4Ni4xNzkgMjcyLjg0TDQ5My4yMzQgMjcyLjg0QzUwMi4zMzYgMjcyLjg0IDUwOS43MzIgMjY1LjIxNiA1MDkuNzMyIDI1NS43NzJDNTA5LjczMiAyNDYuNTU2IDUwMi4zMzYgMjM4LjgxOSA0OTMuMjM0IDIzOC44MTlaIiBmaWxsPSIjZjBmNmZjIiBmaWxsLXJ1bGU9ImV2ZW5vZGQiIG9wYWNpdHk9IjEiIHN0cm9rZT0ibm9uZSIvPgo8L2c+Cjwvc3ZnPgo=',
      66
    );
  }

  public static function glasses_settings_page() {
    echo '<h1>Glasses for WooCommerce</h1>';
    echo '<p class="glasses__description">
            Clicking the button below will loop through all of your published products and assign a color attribute to 
            them auto-magically. Review the colors <a target="_blank" href="edit-tags.php?taxonomy=pa_color&post_type=product">here</a> 
            to change them to more friendly names.
          </p>';

    if (!class_exists('WooCommerce')) {
      echo '<div class="glasses__process-data" data-process style="filter: grayscale(1)">Process Colors</div>';
      return;
    }

    echo '<div class="glasses__process-data" data-process>Process Colors</div>';
  }

  public static function enqueue_admin_assets() {
    $plugin_url = self::plugin_url();
    wp_enqueue_style('glasses', $plugin_url . '/assets/css/style.css');
    wp_enqueue_script('glasses', $plugin_url . '/assets/js/main.js', ['jquery']);
  }

  public static function enable_woocommerce() {
    $class = 'notice notice-error';
    $message = __('Oops! Enable WooCommerce plugin to use Glasses for WooCommerce.', 'glasses-for-woocommerce');
    printf('<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html($message));
  }
}
