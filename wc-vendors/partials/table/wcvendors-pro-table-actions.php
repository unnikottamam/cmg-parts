<?php
/**
 * Dashboard action URL
 *
 * This file is used to display a dashboard action url
 *
 * @link       http://www.wcvendors.com
 * @since      1.0.0
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/helpers/table
 */
?>

<div class="row-actions-<?php echo $this->id; ?>">
    <?php
    foreach ($this->actions as $action => $details) {
      if (!empty($details)) {
        if (empty($details['url'])) {
          if ($action == 'view') {
            $action_url = get_permalink($object_id);
          } else {
            $action_url = WCVendors_Pro_Dashboard::get_dashboard_page_url(
              $this->post_type . '/' . $action . '/' . $object_id
            );
          }
        } else {
          $action_url = $details['url'];
        }
      }

      !empty($details['class'])
        ? ($class = 'class="wcv__tablebtn ' . $details['class'] . '"')
        : ($class = 'class="wcv__tablebtn "');
      !empty($details['id'])
        ? ($id = 'id="' . $details['id'] . '"')
        : ($id = '');
      !empty($details['target'])
        ? ($target = 'target="' . $details['target'] . '"')
        : ($target = '');
      $custom = '';
      if (!empty($details['custom'])) {
        foreach ($details['custom'] as $attr => $value) {
          $custom .= $attr . '="' . $value . '" ';
        }
      }

      echo '<a href="' .
        $action_url .
        '" ' .
        $id .
        ' ' .
        $class .
        ' ' .
        $target .
        ' ' .
        $custom .
        ' >' .
        $details['label'] .
        '</a>';
    }
    if (get_post_status($object_id) == 'publish') {
      $gadata = getGAData($object_id);
      if (($gadata && $gadata > 1) || get_field('lead_count', $object_id)) { ?>
    <ul class="wcv__list">
        <?php
        if ($gadata && $gadata > 1) { ?>
        <li>
            Total Product Views :
            <strong><?php echo $gadata; ?></strong>
        </li>
        <?php }
        if (get_field('lead_count', $object_id)) {
          if ($gadata && $gadata > 1) {
            echo '<hr>';
          } ?>
        <li>
            Total Number of Interests / Leads <br><small class="wcv__danger">From September 2021 onwards</small> :
            <strong><?php echo get_field('lead_count', $object_id); ?></strong>
        </li>
        <?php
        }
        ?>
    </ul>
    <?php }
    }
    ?>
</div>