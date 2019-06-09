こちらのアプリケーションには以下の特徴があります。

- CakePHPを使用
- Dockerによる環境の構築
- CircleCIによるコードチェック
- Githubによるソースコード管理

試していきたい技術はこちらのアプリケーションに随時組み込んでいく予定です。

## 要件定義
今回は以下のように要件を整理してみました

### 必要な要件
- ユーザーは質問や回答を見ることができる
  - 回答は質問に紐付く
- ユーザーは質問や回答を見ることができる
- 質問と回答は誰でも見ることが出来る
- 質問と回答を投稿する場合は、ログインが必要
  - ログインはユーザー任意に決めたIDとパスワードでおこなう
- ログインするにはユーザー登録が必要
- ログイン後はログアウトすることができる

### 必要ではない要件
- 質問・回答共に画像や動画は投稿できない
  - テキストのみ投稿できる
- 質問と回答は一度投稿したら編集することはできない
  - 削除はできる
  - 削除できるのはその投稿をしたユーザーのみ
- 質問にカテゴリーのような区分は不要
- ユーザー退会及びパスワード再発行機能は今回は実装しない
  - 当面は問い合わせベースで対応する

### 画面一覧

| 画面名 | 機能 | 補足 |
|:-----------:|:------------|:------------|
| 質問一覧画面 | 質問が一覧で表示される<br/>質問を削除できる | 質問は最大1ページ最大20件表示<br/>画面下部からページ遷移できる<br/>質問投稿画面へのリンクが上部にある |
| 質問詳細画面 | 質問とその回答が一覧で表示される<br/>回答を投稿できる<br/>質問を削除できる | 回答投稿後は元の詳細画面に遷移する |
| 質問投稿画面 | 質問を投稿できる | 質問投稿後は質問一覧画面に遷移する |
| ユーザー登録画面| ユーザー情報を登録できる | 登録後はログイン画面に遷移する |
| ログイン画面 | ログインできる(ID/パスワード) | ログイン後は質問一覧画面に遷移する |
| ユーザー編集画面 | ユーザー情報を編集できる | パスワード更新画面へのリンクが上部にある |
| パスワード更新画面 | パスワードを更新できる | 変更後はユーザー編集画面に遷移する |

### 細かい要件
- 質問一覧は投稿が新しいものから順に表示する
- 回答一覧は投稿が古いものから順に表示する
- 1回の質問及び回答共に最大140文字まで投稿できる
- 1つの質問につき、回答は最大100件まで投稿することができる
- ユーザー登録字に必要な情報はユーザーIDとニックネームとパスワード
  - ユーザーIDはユニーク(一意)とする
  - パスワードは半角円数字混在8文字以上をする
- ヘッダーのリンクをログイン前後で変える
  - ログイン前：ユーザー登録がめんとログイン画面のリンク
  - ログイン後：ユーザー編集画面とログアウトのリンク
