# POSletics API

## GET */users*

Liefert alle Benutzer zurück

Als Antwort bekommt man ein Array mit allen Benutzern zurück:
```js
[
  {
    "id": 1,
    "name": "Klaus",
    "route": [ 1, 2, 3 ]
  },
  {
    ...
  }
]
```

## GET */pos*

Liefert alle verfügbaren POS samt Hashtags zurück

Als Antwort bekommt man alle verfügbaren POS samt Hashtags zurück.

```js
[
  {
    "id": 1,
    "lat": "51.481846",
    "lng": "7.216236",
    "upvotes": 0,
    "user_id": 4,
    "hashtags": []
  },
  {
    "id": 2,
    "lat": "51.481846",
    "lng": "7.216236",
    "upvotes": 0,
    "user_id": 4,
    "hashtags": [
      {
        "id": 1,
        "name": "#test",
        "upvotes": 0
      }
    ]
  }
]
```

## POST */pos*

Erzeugt einen neuen POS.

Dabei werden folgende Werte als JSON Body erwartet:
```js
{
  "lat"       // Pflicht, Zahl, Braitengrad
  "lng"       // Pflicht, Zahl, Längengrad
  "user_id"   // Pflicht, Zahl, eine gültige Benutzer ID
  "hashtags"  // Optional, Array mit Hashtag Objekten
}
```

Ein Hashtag hat die Struktur:
```js
{
  "name"
  "upvotes"
}
```

Beispiel:
```js
{
  "lat": 123,
  "lng": 123,
  "user_id": 1,
  "hashtags": [
    { "name": "#WOW" },
    { "name": "#Hashtag", "upvotes": 2 }
  ]
}
```

## PATCH */pos/*{id}

Bearbeitet einen bestehenden POS

Dabei werden folgende Werte als JSON Body erwartet:
```js
{
  "lat"       // Optional, Braitengrad
  "lng"       // Optional, Längengrad
  "hashtags"  // Array mit Hashtag Objekten (siehe POST /pos)
}
```

## POST */pos/upvote/*{id}

Upvotes eines POS +1

## POST */pos/downvote/*{id}

Upvotes eines POS -1

## PATCH */hashtags/*{id}

Bearbeitet einen bestehenden Hashtag

Dabei werden folgende Werte als JSON Body erwartet:
```js
{
  "name"       // Optional, Braitengrad
  "upvotes"    // Optional, Längengrad
}
```

## GET */route*

Liefert die zuletzt erstellte Route von einem Benutzer

Dabei werden folgende Werte als JSON Body erwartet:
```js
{
  "user_id"     // Pflicht, ID eines Benutzers
}
```

Alternativ kann auch die ID als Querystring übergeben werden. Z.B:

```
/route?user_id=1
```

Als Antwort bekommt man ein Array mit den IDs der jeweiligen POS der Route. Z.B:
```js
[1, 6, 9, 4]
```

## POST */hashtags/upvote/*{id}

Upvotes eines Hashtags +1

## POST */hashtags/downvote/*{id}

Upvotes eines Hashtags -1

## POST */route*

Speichert eine Route zu einem bestimmten Benutzer

Dabei werden folgende Werte als JSON Body erwartet:
```js
{
  "user_id"     // Pflicht, ID eines Benutzers
  "route"       // Pflicht, Array mit IDs von POS
}
```

Beispiel:
```js
{
  "user_id": 1,
  "route": [1, 2, 3, 4]
}
```

