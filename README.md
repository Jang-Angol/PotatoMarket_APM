#### PotatoMarket_APM

### 기획의도

아이템거래를 마비노기 시장카페를 자주 이용하지만

네이버카페이기 때문에 기능에 제한이 있는 경우가 많다.

ex) 아이템 검색(이름) 어려움, 시세파악 어려움, 옵션 검색이 불가

그러한 것들을 보완하고자 웹페이지를 구축하여

기능들을 구현해보고자 한다.

사이트의 목적이 상거래이기 때문에

추후에 만들어진 사이트의 텍스트만 바꾸어

쇼핑몰이나 다른 서비스를 구축할 수 있도록 모듈을 만드는 것이 목적이다.

### 기능

## 회원가입/로그인

ID 영문소문자, 숫자, 언더바(_) 8~20자

- 아이디는 영문 8~20자로 입력해주세요.

PW 영문 대소문자, 숫자, 특수문자(!,@,#,$,%,^,&,*)를 꼭 포함하여 8~20자

- 대소문자, 숫자, 특수문자(!,@,#,$,%,^,^,&,*)를 하나씩 포함하여 8자 이상 입력해주세요.
- 비밀번호가 일치하지 않습니다.

케릭터 아이디 

- 한글 2~8자+숫자 영문 3~12자+숫자
- 한글,영문 혼용 불가
- 첫글자로 숫자가 들어가면 안됨
- 올바르지 않은 닉네임입니다.

서버

연락처(핸드폰)

- 숫자만 입력해주세요.

이메일

→ 연락처와 이메일은 아이디 찾기 혹은 pw찾기를 위해 사용됨

- 올바르지 않은 이메일 주소입니다.

## 판매/구매 CRUD

# 기획

item 판매 (쇼핑몰처럼 구현)

- 박스 아이콘 형 디스플레이
- 아이템 이미지, 아이템 이름, 아이템 가격을 표시
- 아이콘 hover시 아이템 옵션 공개

있어야할 정보

- 거래서버
- 판매상태(판매중/거래완료/예약중)
- item 명
- item image
- item option(세공, 방보, 인챈트)
- item 가격
- 거래불가 아이템(신세,거불크세,거불인보포등)
- 아이콘 hover시 아이템 정보 view

거래상태: 판매중, 구매중, 거래완료, 예약중

신청상태: 판매신청, 구매신청, 거래중, 예약신청(기간 필요), 예약중

거래수락

이미지 파일은 1개만 업로드 → 아이템당 하나의 이미지면 충분

 판매/구매중인 게시글만 삭제 가능

거래완료시 게시글 삭제 불가

판매/구매 신청시 모달페이지로 신청

흥정시 아이템 가격 -10%까지만 가능

## 시나리오

판매 Scenario

1. 판매자 User가 판매글(아이템정보- 이름 옵션 이미지(선택가능), 아이템 판매가격)을 등록
2. 구매자 User가 판매글을 보고 구매 신청을 함

    2.1 구매자 User가 흥정신청을 함(흥정이 가능할경우)

    2.1.1 판매자 User가 흥정을 수락함 → 판매가격이 변경됨 → 구매신청으로 넘어감

    2.1.2 판매자 User가 흥정을 거절함 → 구매신청이 취소됨

3. 판매자 User가 구매신청을 보고 수락을 함
4. 거래가 이루어짐
5. 거래완료를 누름
6. 거래내역(판매자, 구매자, 아이템 거래가격)이 등록됨

구매 Scenario

1. 구매자 User가 구매글(아이템정보, 아이템 구매 가격)을 등록
2. 판매자 User가 판매신청(판매하고자 하는 item 정보)을 등록

    2.1. 판매자 User가 흥정신청을 함

    2.1.1 구매자 User가 흥정을 수락함

3. 구매자 User가 판매신청을 보고 수락을 함
4. 거래가 이루어짐
5. 거래완료를 누름
6. 거래내역(판매자, 구매자, 아이템 거래가격)이 등록됨


