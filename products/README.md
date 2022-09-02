<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

<p align="center">
<a href="https://travis-ci.org/laravel/framework"><img src="https://travis-ci.org/laravel/framework.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>
<h2>網站路由</h2>

![image-20220902153227622](C:\Users\harri\AppData\Roaming\Typora\typora-user-images\image-20220902153227622.png)

<h3>GET</h3>

<table>
    <tr>
        <td>URI</td>
        <td>Action</td>
        <td>說明</td>
    </tr>
	<tr>
        <td>/</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseListPage</td>
        <td>商品列表頁</td>
	</tr>
	<tr>
        <td>/merchandise</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseListPage</td>
        <td>商品列表頁</td>
	</tr>
	<tr>
        <td>/merchandise/create</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseCreate</td>
        <td>商品修改表單頁面</td>
	</tr>
    <tr>
        <td>/merchandise/manage</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseManageListPage</td>
        <td>管理人員商品列表(一般使用者不能檢視)</td>
	</tr>
    <tr>
        <td>/merchandise/{merchandise_id}</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseItemPage</td>
        <td>商品單品顯示頁面</td>
	</tr>
    <tr>
        <td>/merchandise/{merchandise_id}/edit</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseItemEditPage</td>
        <td>商品單品編輯表單頁面</td>
	</tr>
    <tr>
        <td>/transaction</td>
        <td>App\Http\Controllers\TransactionController@transactionListPage</td>
        <td>使用者訂單列表</td>
	</tr>
    <tr>
        <td>/user/auth/get-carts</td>
        <td>App\Http\Controllers\MemberController@getCarts</td>
        <td>API取得使用者購物車內容,顯示於右上方購物車區域,只抓前5筆資料,其他須到購物車列表頁面才會顯示完整內容</td>
	</tr>
    <tr>
        <td>/user/auth/list-cart</td>
        <td>App\Http\Controllers\MemberController@listCart</td>
        <td>購物車列表頁API,取得使用者購物車內容</td>
	</tr>
    <tr>
        <td>/user/auth/sign-in</td>
        <td>App\Http\Controllers\MemberController@signInPage</td>
        <td>使用者登入表單頁面</td>
	</tr>
    <tr>
        <td>/user/auth/sign-out</td>
        <td>App\Http\Controllers\MemberController@signOut</td>
        <td>使用者登出程序</td>
	</tr>
    <tr>
        <td>/user/auth/sign-up</td>
        <td>App\Http\Controllers\MemberController@signUpPage</td>
        <td>使用者註冊頁面</td>
	</tr>
</table>

<h3>POST</h3>

<table>
    <tr>
        <td>URI</td>
        <td>Action</td>
        <td>說明</td>
    </tr>
	<tr>
        <td>/merchandise/create</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseCreateProcess</td>
        <td>商品新增表單處理頁面</td>
	</tr>
    <tr>
        <td>/transaction</td>
        <td>App\Http\Controllers\TransactionController@transaction</td>
        <td>訂單確認頁面</td>
	</tr>
    <tr>
        <td>/transaction/buy</td>
        <td>App\Http\Controllers\TransactionController@buy</td>
        <td>訂單確認後,後端處理程序,新增訂單、訂單商品資料,寄信通知使用者下單成功</td>
	</tr>
    <tr>
        <td>/user/auth/add-cart</td>
        <td>App\Http\Controllers\MemberController@addCart</td>
        <td>API新商商品到購物車</td>
	</tr>
    <tr>
        <td>/user/auth/cart-delete</td>
        <td>App\Http\Controllers\MemberController@cartDelete</td>
        <td>API刪除購物車商品</td>
	</tr>
    <tr>
        <td>/user/auth/cart-edit-number</td>
        <td>App\Http\Controllers\MemberController@cartEditNumber</td>
        <td>API修改購物車數量</td>
	</tr>
    <tr>
        <td>/user/auth/sign-in</td>
        <td>App\Http\Controllers\MemberController@signInProcess</td>
        <td>使用者登入處理程序</td>
	</tr>
    <tr>
        <td>user/auth/sign-up</td>
        <td>App\Http\Controllers\MemberController@signUpProcess</td>
        <td>使用者註冊處理程序</td>
	</tr>
</table>

<h3>PUT</h3>

<table>
    <tr>
        <td>URI</td>
        <td>Action</td>
        <td>說明</td>
    </tr>
	<tr>
        <td>/merchandise/{merchandise_id}</td>
        <td>App\Http\Controllers\MerchandiseController@merchandiseItemUpdateProcess</td>
        <td>商品更新(後端)處理</td>
	</tr>
</table>