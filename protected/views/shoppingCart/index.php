<?php
require_once('protected/scripts/globals.php');
$this->breadcrumbs = array(
	'Shopping',
	'Cart'
);
?>
<style>
	.input-text,
	.close-icon,
	.coupon {
		position: relative;
	}

	.input-text {
		outline: 0;
	}

	.input-text:focus {
		box-shadow: 0 0 15px 5px #b0e0ee;
		border: 2px solid #bebede;
	}

	.close-icon {
		border: 1px solid transparent;
		background-color: transparent;
		display: inline-block;
		vertical-align: middle;
		outline: 0;
		cursor: pointer;
	}

	.close-icon:after {
		content: "X";
		display: block;
		width: 15px;
		height: 15px;
		position: absolute;
		background-color: #FA9595;
		z-index: 1;
		right: 35px;
		top: 0;
		bottom: 0;
		margin: auto;
		padding: 2px;
		border-radius: 50%;
		text-align: center;
		color: white;
		font-weight: normal;
		font-size: 12px;
		box-shadow: 0 0 2px #E50F0F;
		cursor: pointer;
	}
</style>
<div class="single-product-area">
	<div class="zigzag-bottom"></div>
	<div class="container">
		<div class="row">

			<!-- Sidebar -->
			<?php $this->widget('application.widgets.sidebar_left'); ?>

			<div class="col-md-9">
				<?php if (!isset(Yii::app()->session['cart']) || empty(Yii::app()->session['cart'])) : ?>
					<div class="row">
						<div class="create-account" style="text-align: center; text-decoration: none;">
							<p>Your cart is currently empty.</p>
							<br>
							<p><a style="text-decoration: none;" class="button" href="/" type="submit" name="calc_shipping">Go to shop</a>
							</p>
							<div class="clear"></div>
						</div>
					</div>
				<?php endif; ?>
				<div class="product-content-right">
					<div class="woocommerce" id="the_cart_component">
						<table cellspacing="0" class="shop_table cart">
							<thead>
								<tr>

									<th class="product-thumbnail">&nbsp;</th>
									<th class="product-name">Product</th>
									<th class="product-price">Price</th>
									<th class="product-quantity">Quantity</th>
									<th class="product-remove">&nbsp;</th>
									<th class="product-subtotal">Total</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($data as $key => $value) : ?>
									<tr class="cart_item">

										<td class="product-thumbnail">
											<a href="product/detail/<?= getOptionSlug('product_id', $value['id']) ?>"><img width="145" height="145" alt="poster_1_up" class="shop_thumbnail" src="<?= get_BaseUrl() . $value['product_image'] ?>"></a>
										</td>

										<td class="product-name">
											<a href="product/detail/<?= getOptionSlug('product_id', $value['id']) ?>" title="<?= $value['product_name'] ?>"><?= getSubStrString($value['product_name'], 25) ?></a>
										</td>

										<td class="product-price">
											<span class="amount"><?= get_price_apply_i18n($value['price']) ?></span>
										</td>

										<td class="product-quantity">
											<div class="quantity buttons_added">
												<input type="button" id="minus_quality_input_<?= $key ?>" class="minus" value="-" onclick="minusCartItem(<?= $key ?>)">
												<input type="number" size="3" required name='quality_item_cart_<?= $key ?>' id="quality_item_cart_<?= $key ?>" class="input-text qty text" title="Qty" value="<?= $value['quality'] ?>" min="0" step="1">
												<input type="button" onclick="plusCartItem(<?= $key ?>)" id="plus_quality_input_<?= $key ?>" class="plus" value="+">
												<span>&nbsp;</span>
											</div>
										</td>

										<td class="product-remove">
											<a title="Update this item" class="glyphicon glyphicon-ok" href="javascript:voice(0);" onclick="editQtyCartItem(<?= $key ?>)"></a>
											<hr>
											<a title="Remove this item" class="remove" href="javascript:voice(0);" onclick="deleteCartItem(<?= $key ?>)">x</a>
										</td>

										<td class="product-subtotal">
											<span class="amount"><?= get_price_apply_i18n($value['quality'] * $value['price']) ?></span>
										</td>
									</tr>
								<?php endforeach; ?>
								<tr>
									<td class="actions" colspan="6">
										<div class="coupon">
											<label for="coupon_code">Coupon:</label>
											<input type="text" placeholder="Coupon code" value="<?= Yii::app()->session['input_add_coupon'] ?>" id="coupon_code" class="input-text" name="coupon_code">
											<button onclick="cancelCoupon()" class="close-icon" id="cancelCoupon" type="reset"></button>
											<input type="submit" onclick="addCouponCart()" name="apply_coupon" value="Apply Coupon" class="button">
										</div>
										<input type="submit" value="Update Cart" name="update_cart" class="button">
										<a type="submit" <?php echo (isset($data) && !empty($data)) ? '' : 'style="pointer-events: none;background:#E0F5F8"' ?> name="proceed" class="checkout-button button alt wc-forward" href="/checkout">Checkout</a>
									</td>
								</tr>
							</tbody>
							<?php if (Yii::app()->session['result_add_coupon']) { ?>
								<tbody>
									<tr>
										<td colspan="6"><span id="result_add_coupon" style="font-weight: bold;color:red;">
												<?php
												echo Yii::app()->session['result_add_coupon'];
												?>
											</span>
										</td>
									</tr>
								</tbody>
							<?php } ?>
						</table>

						<div class="cart-collaterals">


							<div class="cross-sells">
								<h2>You may be interested in...</h2>
								<ul class="products">
									<li class="product">
										<a href="single-product.html">
											<img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-2.jpg">
											<h3>Ship Your Idea</h3>
											<span class="price"><span class="amount">£20.00</span></span>
										</a>

										<a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
									</li>

									<li class="product">
										<a href="single-product.html">
											<img width="325" height="325" alt="T_4_front" class="attachment-shop_catalog wp-post-image" src="img/product-4.jpg">
											<h3>Ship Your Idea</h3>
											<span class="price"><span class="amount">£20.00</span></span>
										</a>

										<a class="add_to_cart_button" data-quantity="1" data-product_sku="" data-product_id="22" rel="nofollow" href="single-product.html">Select options</a>
									</li>
								</ul>
							</div>


							<div class="cart_totals ">
								<h2>Cart Totals</h2>

								<table cellspacing="0">
									<tbody>
										<tr class="cart-subtotal">
											<th>Quality Subtotal</th>
											<td><span class="amount"><?= $total_quality_cart ?></span></td>
										</tr>
										<tr class="order-total">
											<th>Price Subtotal</th>
											<td><strong><span class="amount"><?= get_price_apply_i18n(Cart::totalPriceNotDiscount()) ?></span></strong> </td>
										</tr>
										<tr class="shipping">
											<th>Shipping and Handling</th>
											<td>Free Shipping</td>
										</tr>
									</tbody>
									<tbody>
										<tr class="cart-subtotal">
											<th colspan="2">Coupons</th>
										</tr>
										<tr>
											<td colspan="2" style="text-align: center;">
												<strong><?= Yii::app()->params->the_coupon_1 ?></strong>
											</td>
										</tr>
									</tbody>
									<tbody>
										<tr class="cart-subtotal">
											<th>Quality Total</th>
											<td><strong><?= get_price_apply_i18n(Cart::totalPrice()) ?></strong></td>
										</tr>
										<tr>
											<td colspan="2">
												<?php
												$currency_name_data = CurrencyRate::model()->getCurrencyByCode(Yii::app()->params->currency);
												$data_currency = '';
												foreach ($currency_name_data as $value) {
													$data_currency = $value['currency_name'];
												}
												$convert = new ConvertNumberToWord();
												if (!empty(Cart::totalPrice())) {
													echo ucwords(strtolower($convert->convert(get_total_price_cart_i18n()) . ' ' . $data_currency));
												} else {
													echo 'None';
												}
												?>
											</td>
										</tr>
									</tbody>
								</table>
							</div>


							<!-- <form method="post" action="#" class="shipping_calculator">
								<h2><a class="shipping-calculator-button" data-toggle="collapse" href="#calcalute-shipping-wrap" aria-expanded="false" aria-controls="calcalute-shipping-wrap">Calculate Shipping</a></h2>

								<section id="calcalute-shipping-wrap" class="shipping-calculator-form collapse">

									<p class="form-row form-row-wide">
										<select rel="calc_shipping_state" class="country_to_state" id="calc_shipping_country" name="calc_shipping_country">
											<option value="">Select a country…</option>
											<option value="AX">Åland Islands</option>
											<option value="AF">Afghanistan</option>
											<option value="AL">Albania</option>
										</select>
									</p>

									<p class="form-row form-row-wide"><input type="text" id="calc_shipping_state" name="calc_shipping_state" placeholder="State / county" value="" class="input-text"> </p>

									<p class="form-row form-row-wide"><input type="text" id="calc_shipping_postcode" name="calc_shipping_postcode" placeholder="Postcode / Zip" value="" class="input-text"></p>


									<p><button class="button" value="1" name="calc_shipping" type="submit">Update Totals</button></p>

								</section>
							</form> -->
							<?php if (isset($data) && !empty($data)) { ?>
								<div class="cart_totals ">
									<a type="submit" name="proceed" class="checkout-button button alt wc-forward" href="/checkout">Checkout</a>
								</div>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	var url = '<?php echo Yii::app()->request->baseUrl ?>';

	function editQtyCartItem(id) {
		number = $('#quality_item_cart_' + id).val();
		$.post(url + '/shoppingCart/updateItemCart', {
			'product_id': id,
			'quality': number,
		}, function(data) {
			$('#quality_cart').text(data);
			$('#the_cart_component').load(url + '/shoppingCart/index #the_cart_component');
			$('#mini-cart-menu').load(url + '<?= $_SERVER['REQUEST_URI'] ?> #mini-cart-menu');
		});
	}

	function plusCartItem(id) {
		const total_qty = new Number($('#quality_item_cart_' + id).val());
		$('#quality_item_cart_' + id).val((total_qty + 1));
	}

	function minusCartItem(id) {
		const total_qty = new Number($('#quality_item_cart_' + id).val());
		$('#quality_item_cart_' + id).val((total_qty - 1));
	}

	function deleteCartItem(id) {
		$.post(url + '/shoppingCart/deleteCartItem', {
			'product_id': id,
		}, function(data) {
			$('#quality_cart').text(data);
			$('#the_cart_component').load(url + '/shoppingCart/index #the_cart_component');
			$('#mini-cart-menu').load(url + '<?= $_SERVER['REQUEST_URI'] ?> #mini-cart-menu');
		});
	}

	function addCouponCart() {
		var coupon_code = $('#coupon_code').val();
		$.post(url + '/shoppingCart/AddCoupon', {
			'coupon_code': coupon_code,
		}, function(data) {
			$('#the_cart_component').load(url + '/shoppingCart/index #the_cart_component');
			$('#mini-cart-menu').load(url + '<?= $_SERVER['REQUEST_URI'] ?> #mini-cart-menu');
		});
	}

	function cancelCoupon() {
		$.post(url + '/shoppingCart/cancelCoupon', {}, function(data) {
			$('#the_cart_component').load(url + '/shoppingCart/index #the_cart_component');
			$('#mini-cart-menu').load(url + '<?= $_SERVER['REQUEST_URI'] ?> #mini-cart-menu');
		});
	}
</script>