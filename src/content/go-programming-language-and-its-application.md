---
author: Shihab Mahamud
title: গো প্রোগ্রামিং ভাষা এবং এর প্রয়োগ
date: 2022-09-03
desc: Go একটি statically typed compiled প্রোগ্রামিং ভাষা, যাকে প্রায়শই 21 শতকের C ও বলা হয়। এটি high-performance server-side অ্যাপ্লিকেশনগুলির জন্য একটি জনপ্রিয় পছন্দ এবং এটি এমন একটি ভাষা যা দিয়ে Docker, Kubernetes, CockroachDB এবং D-Graph এর মতো Cloud Native Tools তৈরি করা হয়েছে। এটি Google-এ 2007 সালে legends দের দ্বারা তৈরি করা হয়েছিল

tags: ["programming", "go", "c"]
categories: ["Code"]
series: ["software-development"]

img: /img/go-programming-language-and-its-application.png
imgWidth: 500
imgHeight: 500
---

## The Go Programming Language

Go একটি statically typed compiled প্রোগ্রামিং ভাষা, যাকে প্রায়শই 21 শতকের C ও বলা হয়। এটি high-performance server-side অ্যাপ্লিকেশনগুলির জন্য একটি জনপ্রিয় পছন্দ এবং এটি এমন একটি ভাষা যা দিয়ে Docker, Kubernetes, CockroachDB এবং D-Graph এর মতো Cloud Native Tools তৈরি করা হয়েছে। এটি Google-এ 2007 সালে legends দের দ্বারা তৈরি করা হয়েছিল। যেমন: Ken Thompson, যিনি B এবং C প্রোগ্রামিং ভাষার উদ্ভাবক। Version 1.0 2012 সালে ওপেন-সোর্স সফ্টওয়্যার হিসাবে প্রকাশ করা হয়েছিল। এটি simplicity এবং efficiency জন্য ডিজাইন করা হয়েছিল। এর সোর্স কোড সরাসরি মেশিন কোডে কম্পাইল করা হয়, এটির কম্পাইলেসন টাইয় খুবই কম যা সম্ভম হয়েছে dependency analysis উদ্ভাবনের দ্বারা। যদিও এটি একটি statically টাইপ ভাষা, তার পরও এটি একটি সিনট্যাক্স প্রদান করে টাইপ ইনফারেন্সের মাধ্যেমে, যা খুব সংক্ষিপ্ত এবং ব্যবহারিক। এটিতে একটি প্যাকেজ এবং মডিউল সিস্টেম রয়েছে যা project গুলোর মধ্যে কোড import এবং export করা সহজ করে তোলে। Go কোড লেখা শুরু করতে গেলে প্রথমে Go ইন্সটল করুন এবং তারপরে আপনার সিস্টেমে একটি খালি ডিরেক্টরি খুলুন .go-তে শেষ হওয়া একটি ফাইল তৈরি করুন, তারপর একটি স্বতন্ত্র এক্সিকিউটেবল তৈরি করতে শীর্ষে ‘package main’ যোগ করুন, তারপর একটি main function ঘোষণা করুন যেখানে আপনার প্রোগ্রামটি execution করা শুরু হবে।

```go
package main

import "fmt"

func main() {
    fmt.Println("Hello World!")
}
```

গণিত, নেটওয়ার্কিং বা ফরম্যাটেড আইওর মতো সাধারণ প্রয়োজনীয়তাগুলি পরিচালনা করার জন্য গো-তে মূল প্যাকেজগুলির একটি স্ট্যান্ডার্ড লাইব্রেরি রয়েছে। “fmt” import করে আমরা স্ট্যান্ডার্ড আউটপুটে একটি লাইন প্রিন্ট করতে পারি। তারপর ‘go build’ কমান্ড চালাতে পারি এবং এটি দ্রুত সোর্স কোড এবং dependency গুলিকে একটি এক্সিকিউটেবল বাইনারিতে কম্পাইল করে। Go হল C বা C++ এর সংক্ষিপ্ত সংস্করণের মতো একটি ভেরিয়েবল ডিক্লেয়ার করে var কীওয়ার্ড এর নাম এবং টাইপ অনুসরণ করে এবং এটিকে একটি মান দিয়ে শুরু করুন অথবা আপনি var প্রতিস্থাপন করতে সংক্ষিপ্ত অ্যাসাইনমেন্ট সিনট্যাক্স ব্যবহার করতে পারেন এবং Go স্বয়ংক্রিয়ভাবে টাইপটি অনুমান করবে।

```go
package main

import "fmt"

func main() {
    var first string = "Hello"
    second := "World"
    fmt.Println(first, second)
}
```

আপনি একটি লাইন থেকে একাধিক ভেরিয়েবল define করতে পারেন।

```go
package main

import "fmt"

func main() {
    name, age, likesGo := "Shihab", 19, true
    fmt.Println(name, age, likesGo)
}
```

গো-তে অন্যান্য সমস্ত বৈশিষ্ট্য রয়েছে যা আপনি একটা প্রোগ্রামিং ভাষাতে আশা করেন। যেমন: array, map, loop এবং control flow । Go আপনাকে পয়েন্টার ব্যবহার করে একটি variable এর মেমরি ঠিকানা সংরক্ষণ করার অনুমতি দেয়। গো রুটিন ব্যবহার করে এটি concurrency হ্যান্ডেল করতে পারে।

## Application of Go

Go ব্যবহার করে সাধারণত এমন application লেখা হয়, যার প্রায়শই নতুন feature আসে এবং যার requirement প্রায়শই change হয়। এছাড়াও ব্যপকভাবে এটি দিয়ে system level এর Cloud Native এবং Network Services লেখা হয়। Docker, Kubernetes শক্তিশালী Tool গো দিয়ে তৈরি করা হয়েছে। তাই এগুলো নিয়ে in-dept এ কাজ করতে হলে Go যানা অপরিহার্য। গো দিয়ে সহজেই Command-line Interfaces Tools তৈরি করা সম্ভব। যার জন্য রয়েছে, spf13/cobra, spf13/viper, urfave/cli, delve, chzyer/readline ইত্যাদির মতো জনপ্রিয় package। গো ব্যবহার করে ব্যপক ভাবে backend web application ও তৈরি করা হয়। যার জন্য গোতে রয়েছে net/http, html/template, flosch/pongo2, database/sql, olivere/elastic ইত্যাদির মতো pacakge। এছাড়াও DevOps & Site Reliability engineer রা এটি দিয়ে automation script ও লেখেন। এখন পয়েন্ট করে বললে গো দিয়ে এই এই সেক্টরে কাজ করা হয়।

-   Cloud & Networking Services: Popular Packages - cloud.google.com/go, aws/client, Azure/azure-sdk-for-go
-   Command-line Interfaces: Popular Packages - spf13/cobra, spf13/viper, urfave/cli, delve, chzyer/readline
-   Web Development: Popular Packages - net/http, html/template, flosch/pongo2, database/sql, olivere/elastic
-   DevOps & Site Reliability: Popular Packages - opentracing/opentracing-go, istio/istio, urfave/cli

আরও অনেক কাজে গো ব্যবহার করা হয়
এই সম্পর্কে আরো জানতে ভিজিট করুন: https://go.dev/solutions/#use-cases
