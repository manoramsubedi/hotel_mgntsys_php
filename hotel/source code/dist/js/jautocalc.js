<input type="text" name="qty" value="1">
2
<input type="text" name="price" value="9.99">
3
<input type="text" name="item_total" value="" jAutoCalc="{qty} * {price}">
4
  ...
5
<td><input type="text" name="total" value="" jAutoCalc="SUM({item_total})"></td>
3. Initialize the AutoCalc plugin and done.