<div class="container">
    <div class = "user-register container">
        <h4>회원가입</h4>
        <form>
            <table class="info-list">
                <tr id="user_id"><td><span><input type="text" class="form-control" placeholder="아이디"></span></td></tr>
                <tr id="user_pw"><td><span><input type="password" class="form-control" placeholder="비밀번호"></span></td></tr>
                <tr id="user_pw_check"><td><span><input type="password" class="form-control" placeholder="비밀번호 확인"></span></td></tr>
                <tr id="user_name">
                    <td>
                        <span>
                            <select class="server-select form-control">
                                <option value="">서버</option>
                                <option value="0">LT</option>
                                <option value="1">HP</option>
                                <option value="2">MD</option>
                                <option value="3">WF</option>
                            </select>
                        </span>
                        <span><input type="text" class="form-control" placeholder="캐릭터명"></span>
                    </td>
                </tr>
                <tr id="user_phonenumber">
                    <td>
                        <ul class="phonenumber clearfix">
                            <li>
                                <span>
                                    <input class="form-control" list="user_phonenumber_head" value="010">
                                    <datalist id="user_phonenumber_head">
                                        <option value="010">
                                        <option value="011">
                                        <option value="016">
                                        <option value="019">
                                        <option value="017">
                                        <option value="018">
                                    </datalist>
                                </span>
                            </li>
                            <li>
                                <span>
                                    <input type="number" class="form-control" maxlength="4">
                                </span>
                            </li>
                            <li>
                                <input type="number" class="form-control" maxlength="4">
                            </li>
                        </ul>
                    </td>
                </tr>
                <tr id="user_email">
                    <td>
                        <ul class="user-email clearfix">
                            <li>
                                <span>
                                    <input type="text" value="" class="form-control" placeholder="Email">
                                </span>
                            </li>
                            <li>
                                <input class="form-control" list="user_email_domain">
                                <datalist id="user_email_domain">
                                       <option value="naver.com">
                                       <option value="hanmail.net">
                                       <option value="gmail.com">
                                       <option value="nate.com">
                                       <option value="hotmail.com">
                                       <option value="paran.com">
                                       <option value="korea.com">
                                       <option value="chol.com">
                                       <option value="daum.net">
                                       <option value="yahoo.com">
                                       <option value="hanafos.co.kr">
                                       <option value="msn.com">
                                       <option value="kebi.com">
                                       <option value="netian.com">
                                       <option value="freechal.com">
                                       <option value="empal.com">
                                 </datalist>
                            </li>
                        </ul>
                    </td>
                </tr>
            </table>
            <div class="register_button_bar">
                <button id="register_button" type="submit" class="btn">가입하기</button>
            </div>
        </form>
    </div>
</div>