---
title: নতুনদের জন্য সমস্যা সমাধান
date: 2022-01-25
author: Shihab Mahamud
desc: Problem এর বাংলা হলো সমস্যা আর Solving হলো সেই সমস্যা সমাধান করা। কিন্তু আমার কাছে Problem বা সমস্যা মানে হলো কোন unknown situation বা অজানা পরিস্থিতি। আর সেই unknown situation থেকে নিজেকে বের করে নিয়ে আসাই হলো Problem solving। Problem solving অনেকটা adventure এর মতো you don't know what will be next।
img: /img/problem-solving-for-beginners.png
imgWidth: 500
imgHeight: 500

tags: ["programming", "problem-solving", "c/c++"]
categories: ["Code"]
series: ["competitive-programming"]
---

Problem এর বাংলা হলো সমস্যা আর Solving হলো সেই সমস্যা সমাধান করা। কিন্তু আমার কাছে Problem বা সমস্যা মানে হলো কোন unknown situation বা অজানা পরিস্থিতি। আর সেই unknown situation থেকে নিজেকে বের করে নিয়ে আসাই হলো Problem solving। Problem solving অনেকটা adventure এর মতো you don't know what will be next।

আমাদের বাস্তব দুনিয়ায় Problem solving সব জায়গা আছে। একজন কৃষক বিভিন্ন ফসল চাষের মাধ্যমে আমাদের খাদ্যের সমস্যা সমাধান করছে। তেমনি একজন ডাক্তার আমাদের শারিরীক সমস্যার সমাধান করে। কিন্তু এগুলোর মধ্যে এই ব্লগে আমরা Programming এর Problem Solving নিয়ে আলোচনা করবো। প্রথমেই আসে Programming এ Problem Solving কি? কোন বাস্তর জিবনের সমস্যা যদি কম্পিউটার বা কম্পিউটিং ডিভাইস দিয়ে সমাধান করা যায় তবে তাকে আমরা Programming এ Problem solving হিসাবে আখ্যায়িত করতে পারি।

তাহলে Problem solving এর ধাপ সমুহ কি হতে পারে। প্রথমে আমাদের সমস্যা খুজে বের করতে হবে। তার পর সমস্যাটিকে analysis করতে হবে। তারপর মনে মনে, খাতায় বা white board ইত্যাদিতে সমস্যাটির সমাধান করতে হবে। এখন পালা সমাধানটি কম্পিউটারকে বুঝানোর। সমাধানটি কম্পিউটারকে বোঝানোর জন্য যেকোন একটি প্রোগ্রামিং ভাষা ব্যবহার করে code লিখে কম্পিউটারকে সমাধানটি বোঝাতে হবে।

তাহলে উদাহরণ হিসেবে একটি Problem দেখা যাক। Problem টি Codeforces Beta Round #4 (Div. 2 Only) এর A নম্বর Problem, যার নাম Watermelon (https://codeforces.com/problemset/problem/4/A) । পরামর্শ রইলো প্রথমে Problem টি ভালো ভাবে পড়ে, এখানে কি বলা হয়েছে তা বুঝার চেষ্টা করা। তবুও আমি সংক্ষেপে Problem টিতে কি বলা হয়েছে তা বলি, Pete এবং Billy Watermelon কিনেছে। এখন তারা এমন ভাবে ওজন অনুযায়ী Watermelon কে ভাগ করতে চায় যে, দুই ভাগের ওজন জোড় সংখ্যা (even number) এবং 0 থেকে বড় হয় । এখন আমাদের বলতে হবে যে আমরা এ রকম ভাবে ভাগ করতে পারবো কি না। যদি পারি তবে YES প্রিন্ট করতে হবে না হলে NO প্রিন্ট করতে হবে। যেমন যদি তাদের Watermelon এর ওজন 8 হয় তবে আমরা 6, 2 বা 4, 4 যেকোন ভাবেই ভাগ করতে। এখানে উল্লেখযোগ্যা বিষয় হলো দুই ভাগ সমান নাও হতে পারে, দুইটি জোড় সংখ্যা (even number) হলেই হবে।

তাহলে Problem Solve করার প্রথম ধাপ Problem Identify বা Problem Read গেলে, এখন আসে Analysis এর পালা। এখানে simple বিষয় হলো একটি সংখ্যা দেবে সেটিকে কি দুটি জোড় সংখ্যায় (even number) ভাগ করা যাবে কি না তা বলতে হবে। তবে এখানে simple analysis হলো যেকােন জোড় সংখ্যাকেই দুইটি জোড় সংখ্যায় ভাগ করা যায়। তবে এখানে একটি কর্ণার কেস রয়েছে, 2 তো জোড় সংখ্যা তাই না। কিন্তু 2 কে আমরা 2, 0 তে ভাগ করতে পারি না কারণ 2, 0 তে ভাগ করলে এখানে 0 আসছে যেটা valid নয়। অবশেষে আমরা conclusion এ পৌছালাম যে, 2 থেকে বড় যেকোন জোড় সংখ্যাকে দুইটি জোড় সংখ্যায় ভাগ করা যাবে। এটা গেলে আমাদের Analysis এবং Problem টিকে মনে মনে Solve করা। এখন পালা implement বা code করার।

আমরা একটি সংখ্যা Input নিবো তারপর চেক করবো সংখ্যাটি 2 থেকে বড় না ছোট, ছোট বা সমান হলে NO প্রিন্ট করবো না হলে চেক করবো সংখ্যাটি 2 দিয়ে ভাগ যায় কি না যদি ভাগ যায় তবে এটি জোড় সংখ্যা YES প্রিন্ট করবো না হলে NO প্রিন্ট করবো। code দেখলে আরো ভালো ভাবে বোঝা যাবে।

আমি তিনটি Language (‌C/C++, Python, Go) এ implement করে দেখালাম। পাঠক যে Language যানে সেটা অনুসরন করতে পারে। আর কােন Programming Language না জানলে যে কােন একটা Language শিখলেই হবে, এই তিনটার যেকোন একটি শিখতে হবে, তেমন কিন্তু নয়। তবে C/C++ recommended থাকবে। কারণ জনগণ Problem Solving এর জন্য এটি সবথেকে বেশি ব্যবহার করে।

C/C++ implementation: https://codeforces.com/contest/4/submission/159295024

```c++
#include <bits/stdc++.h>
using namespace std;

int main()
{
	int num;
	cin >> num;

	if (num <= 2)
		cout << "NO\n";
	else
	{
		if (num % 2 == 0)
			cout << "YES\n";
		else
			cout << "NO\n";
	}
	return 0;
}
```

Python implementation: https://codeforces.com/contest/4/submission/159295164

```py
num = int(input())

if num <= 2:
	print("NO")
else:
	if num % 2 == 0:
		print("YES")
	else:
		print("NO")
```

Go implementation: https://codeforces.com/problemset/submission/4/159295437

```go
package main

import "fmt"

func main() {
	var num int
	fmt.Scanf("%d", &num)

	if num <= 2 {
		fmt.Println("NO")
	} else {
		if num%2 == 0 {
			fmt.Println("YES")
		} else {
			fmt.Println("NO")
		}
	}
}
```

এরকম বিভিন্ন ওয়েব সাইট থেকে আরো অনেক Problem পাওয়া যাবে, যে গুলো সমাধানের মাধ্যমে আমরা আমাদের Problem Solving স্কিল বাড়াতে পারবো। কিছু ওয়েবসাইট: Codeforces, CodeChef, LeetCode, HackerRank, UVA, URI ইত্যাদি।

এটাই ছিল একদম Beginners দের জন্য Problem Solving এর একটা Introduction.
