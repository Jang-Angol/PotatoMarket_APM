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
        <div class="register-img">
            <div class="preview">
            </div>
            <input type="file" id="item_img" accept="image/*" onchange="setPreviewImage(event);"/>
        </div>
        <div class="register-info">
            <table>
                <tbody>
                    <tr>
                        <th>판매 가격</th>
                        <td class="item-price"><input type="number" class="form-control" placeholder="골드"/></td>
                    </tr>
                    <tr>
                        <th>아이템 옵션</th>
                        <td class="item-opt"><span><input id="item_opt1" type="text" class="form-control" placeholder="옵션1" maxlength="8"/></span> , <span><input id="item_opt2" type="text" class="form-control" placeholder="옵션2" maxlength="8"/></span> , <span><input id="item_opt3" type="text" class="form-control" placeholder="옵션3" maxlength="8"/></span></td>
                    </tr>
                    <tr>
                        <th>설명</th>
                        <td><textarea rows="5" wrap="virtual" class="form-control" maxlength="255"></textarea></td>
                    </tr>
                    <tr>
                        <th>검색 태그</th>
                        <td class="item-tag"><input type="text" class="form-control"></td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="submit-button">
            <button type="submit" >등록하기</button>
        </div>
    </form>
    <div class="back_button">
        <button onClick="history.back()">뒤로가기</button>
    </div>
</div>
<script>
    var titleCheck = /[^a-zA-Z0-9가-힣ㄱ-ㅎㅏ-ㅣ\,\.\?\!]/;
    var optionCheck = /[^가-힣0-9]/

    function setPreviewImage(event){
        var reader = new FileReader();

        reader.onload = function(event) {
            var img = document.createElement("img");
            img.setAttribute("src", event.target.result);
            $(".preview").children("img").remove();
            $(".preview").append(img);
        };

        reader.readAsDataURL(event.target.files[0]);
    }

</script>