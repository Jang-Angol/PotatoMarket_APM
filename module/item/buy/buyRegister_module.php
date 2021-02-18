<div class="main_contents">
    <hr style="margin: 20px 0px 0px; border: solid 1px #D3CDC2; width: 100%;">
    <form class="register-box">
        <div class="register-title">
            <span>
                <select class="server-select form-control">
                    <option value="">서버</option>
                    <option value="0">LT</option>
                    <option value="1">HP</option>
                    <option value="2">MD</option>
                    <option value="3">WF</option>
                </select>
            </span>
            <span><input type="text" class="form-control" placeholder="아이템명을 입력해주세요."></span>
        </div>
        <div class="register-info">
            <table>
                <tbody>
                    <tr>
                        <th>구매 가격</th>
                        <td class="item-price"><input type="number" class="form-control"/></td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt"><span><input id="item_opt1" type="text" class="form-control" placeholder="옵션1"/></span> , <span><input id="item_opt2" type="text" class="form-control" placeholder="옵션2"/></span> , <span><input id="item_opt3" type="text" class="form-control" placeholder="옵션3"/></span></td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><textarea rows="5" wrap="virtual" class="form-control"/></textarea></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag"><input type="text" class="form-control"/></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="submit-button">
            <button type="submit">등록하기</button>
        </div>
    </form>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>