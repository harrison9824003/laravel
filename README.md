<h2>環境</h2>

<ul>
    <li>PHP 8.1</li>
    <li>vue 2</li>
</ul>

<h2>購物車</h2>

<ul>
    <li>流程
    	<ol>
            <li>前端點擊加入按鈕, 打API到後端</li>
            <li>依登入狀態(登入、為登入)取資料庫 cart 內容</li>
            <li>判斷商品與購物車狀態
                <ul>
                    <li>是否存在購物車</li>
                    <li>購物車數量遞增</li>
                    <li>庫存是否足夠</li>
                    <li>是否為登入狀態</li>
                </ul>
            </li>
            <li>後端回傳加入購物車結果, 更新前端購物車資訊</li>
        </ol>
    </li>
</ul>

