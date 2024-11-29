<?php
/**
 * Table data template
 *
 * This file is used to display the table data
 *
 * @link       http://www.wcvendors.com
 * @since      1.0.0
 * @version    1.6.5
 *
 * @package    WCVendors_Pro
 * @subpackage WCVendors_Pro/public/partials/helpers/table
 */

$pagenum = get_query_var('paged') ? get_query_var('paged') : 1;
$totalpages = 5;
?>
<style>
.wcv__list {
    list-style: none;
    margin: 0.5rem 0;
    border: 1px solid #e3e3e3;
    padding: .5rem 1rem;
    box-shadow: 0 3px 10px -2px #f0f0f0;
    line-height: 1.4;
    max-width: 18rem;
}

.wcv__list li {
    padding: 2px 0;
}

.wcv__list hr {
    margin: 3px 0;
}

.wcv__list small {
    font-size: 15px;
}

.wcv__list strong {
    display: inline-block;
    padding: 3px 9px;
    line-height: 1.1;
    font-size: 14px;
    background: #00548c;
    color: #fff;
    border-radius: 5px;
    font-weight: 400;
}
</style>
<tbody>
    <?php foreach ($this->rows as $key => $row) {
      if (isset($row->action_before)) {
        echo $row->action_before;
      } ?>
    <tr>
        <td>
            <span class="wcv__slno">
                <?php echo $key + 1 + ($pagenum - 1) * $totalpages; ?>
            </span>
        </td>
        <?php foreach ($this->columns as $key => $column) {
          if (
            strtolower($column) == 'id' ||
            stripos($column, 'cart') !== false ||
            stripos($column, 'status') !== false
          ) {
            continue;
          } ?>
        <td class="<?php echo $key; ?>">
            <?php
            if ($key == 'details') {

              if ($row->product->sku) {
                echo '<span class="wcv__danger wcv__sku">SKU: ' .
                  $row->product->sku .
                  '</span>';
              }
              if ($row->product->status != 'publish') {
                echo '<span class="wcv__danger">' .
                  ucfirst($row->product->status) .
                  '</span>';
              }
              ?>
            <h4><?php echo $row->product->name; ?></h4>
            <?php if (
              $row->product->stock_status != 'outofstock' &&
              $row->product->stock_quantity != 0
            ) {
              echo $row->product->get_price_html();
            }
            } else {
              echo $row->$key;
            }

            if ($this->action_column == $key) {
              if (
                $row->product->stock_status != 'instock' ||
                $row->product->stock_quantity == 0
              ) {
                echo '<div class="row-actions-' .
                  $this->id .
                  '"><span class="wcv__tablebtn danger">Sold</span></div>';
              } else {
                if (isset($row->row_actions)) {
                  $this->actions = $row->row_actions;
                }
                $this->display_actions($row->ID);
                if (isset($row->action_after)) {
                  echo $row->action_after;
                }
              }
            }
            ?>
        </td>
        <?php
        } ?>
    </tr>
    <?php
    } ?>
</tbody>