---
author: Shihab Mahamud
title: ইনভার্শন অব কন্ট্রোল নীতি
date: 2022-10-11
desc: ইনভার্শন অব কন্ট্রোল নীতির ব্যবহার | সবাইকে সাগতম আমার নতুন ব্লগে। সম্প্রতি আমি একটি বই পড়ি আ ন ম বজলুর রহমান স্যারের। যার নাম জাভা ওয়েব প্রোগ্রামিং এখানে জাভার একদম মৌলিক কম্পোনেন্ট (যেমন: Servlet, JSP, JDBC, ইত্যাদি) দিয়ে সার্ভার সাইট জাভা ওয়েব অ্যাপ্লিকেশন তৈরির ব্যপারে আলোচনা করা হয়েছে। 

tags: ["programming", "oop", "java", "design-pattern"]
categories: ["Code"]
series: ["software-development"]

img: /img/inversion-of-control.png
imgWidth: 500
imgHeight: 500
---

সবাইকে সাগতম আমার নতুন ব্লগে। সম্প্রতি আমি একটি বই পড়ি আ ন ম বজলুর রহমান
স্যারের। যার নাম [জাভা ওয়েব প্রোগ্রামিং](https://bazlur.com/posts/2020-03-06-%E0%A6%9C%E0%A6%BE%E0%A6%AD%E0%A6%BE-%E0%A6%93%E0%A6%AF%E0%A6%BC%E0%A7%87%E0%A6%AC-%E0%A6%AA%E0%A7%8D%E0%A6%B0%E0%A7%8B%E0%A6%97%E0%A7%8D%E0%A6%B0%E0%A6%BE%E0%A6%AE%E0%A6%BF/),
এখানে জাভার একদম মৌলিক কম্পোনেন্ট (যেমন: Servlet, JSP, JDBC, ইত্যাদি) দিয়ে সার্ভার সাইট
জাভা ওয়েব অ্যাপ্লিকেশন তৈরির ব্যপারে আলোচনা করা হয়েছে। এখানেই শেষের একটি আধ্যয়ে
আলোচনা করা ছিল ইনভার্শন অব কন্ট্রোল ও ডিপেনডেন্সি ইনজেকশন নিয়ে। আমার কাছে মনে
হয়েছে এই বইটি আমাকে ইনভার্শন অব কন্ট্রোল ও ডিপেনডেন্সি ইনজেকশনের গুরুত্বটা নিখুঁতভাবে
বোঝাতে পেরেছে। তাই আমি ভাবলাম এটি নিয়ে একটি ব্লগ লেখা যাক। এই ব্লগে আমরা ইনভার্শন
অব কন্ট্রোল সম্পর্কে যানবো, পরবর্তী কোন ব্লগে ডিপেনডেন্সি ইনজেকশন নিয়ে আলোচনা করা হবে, ইনশাআল্লাহ।

এখন ধরুন আমাদের একটি ক্লাস আছে UserService নামে যার কাজ হলো ইউজার রিলেটেড বিভিন্ন
business লজিক হ্যান্ডেল করা।

```java
public class UserService {
    private final JdbcUserRepository userRepository = new JdbcUserRepository();
    private final MD5PasswordEncryption passwordEncryption = new MD5PasswordEncryption();

    public User saveUser(User user) {
        user.setPassword(passwordEncryption.encrypt(user.getPassword()));
        return userRepository.save(user);
    }
}
```

এখন এই UserService ক্লাস এ আমার দুইটি মেম্বার ভ্যারিয়েবল দেখতে পারছি। যার একটি
JdbcUserRepository এর instance আর একটি হলো MD5PasswordEncryption এর instance।
এ অবস্থায় আমরা এই দুটি ক্লাসকে UserService ক্লাসের ডিপেনডেন্সি বলতে পারি। কারণ
UserService এই দুইটি ক্লাসের অবজেক্ট ছাড়া কাজ করতে পারবে না।

‌আবার আমরা জানি ডিপেনডেন্সি দুই ধরনের হয়:

1. স্টংলি কাপলড ডিপেনডেন্সি (Strongly coupled dependency)
2. লুজলি কাপলড ডিপেনডেন্সি (Loosely coupled dependency)

এখানে দুইটি ক্লাস হলো স্টংলি কাপলসড ডিপেনডেন্সি, কারণ UserService শুধু এই দুইটি
ক্লাসই ব্যবহার করবে। এটি চাইলে অন্য কোনো উপায়ে পাসওয়ার্ড হ্যাস এবং স্টোর করতে
পারবে না। অবজেক্ট ওরিয়েন্টেড সিস্টেমে এই ধরনের স্টংলি কাপলড ডিপেনডেন্সি থাকলে
কোড পরিবর্তন, কোড পুর্নব্যাবহার ছাড়াও না না সমস্যা তৈরি হয়। এখন এর সমাধান হলো
এই দুইটি ক্লাসকে লুজলি কাপলড ডিপেনডেন্সি হিসেবে পরিবর্তন করা।

```java
public interface UserRepository {
    User save(User user);
}

public class JdbcUserRepository implements UserRepository {
    @Override
    public User save(User user) {
        // store user in database
        return user;
    }
}

public class RemoteUserRepository implements UserRepository{
    @Override
    public User save(User user) {
        // send user in other server
        return user;
    }
}
```

```java
public interface PasswordEncryption {
    String encrypt(String password);
}

public class MD5PasswordEncryption implements PasswordEncryption {
    @Override
    public String encrypt(String password) {
        // implement password encryption using MD5
        return password;
    }
}

public class Sha256PasswordEncryption implements PasswordEncryption{
    @Override
    public String encrypt(String password) {
        // implement password encryption using SHA 256
        return password;
    }
}
```

এর জন্য আমরা UserRepository নামে একটি ইন্টারফেস তৈরি করবো। যা ইউজারের তথ্য স্টাের
করার বিভিন্ন method এর api ডিফাইন করবে। এবং এর বিভিন্ন ইমপ্লিমেন্টেশন থাকবে যা
আলাদা আলাদা লজিকের হতে পারবে। যেমন একটি ইমপ্লিমেন্টেশন হয়তো বা ডাটাবেজে ইউজারের তথ্য
স্টোর করাবে। আবার অন্য কোন ইমপ্লিমেন্টেশন হয়তো বা সেটাকে ইন্টানেটে কোথাও পাঠিয়ে দেবে,
সেটা নিরভর করবে তার নিজস্ব দায়িত্ব এর উপর। আবার একই ভাবে PasswordEncryption নামে
ইন্টারফেস থাকবে যার বিভিন্ন ইমপ্লিমেন্টেশন হতে পারে।

```java
public class UserService {
    private final UserRepository userRepository;
    private final PasswordEncryption passwordEncryption;

    public UserService(UserRepository userRepository, PasswordEncryption passwordEncryption) {
        this.userRepository = userRepository;
        this.passwordEncryption = passwordEncryption;
    }

    public User saveUser(User user) {
        user.setPassword(passwordEncryption.encrypt(user.getPassword()));
        return userRepository.save(user);
    }
}
```

এখন আমরা UserService-কে একটু পরিবর্তন করে UserRepository এবং PasswordEncryption
ইন্টারফেসের অবজেক্টে UserService-এর কনস্ট্রাক্টর এর মাধ্যেমে নিয়ে কাজ করবো। তাহলে আমরা দেখতে পারছি
UserService এই ইন্টারফেসের উপর নির্ভর করছে, তার কোন ইমপ্লিমেন্টেশন এর উপর নয়।
এখন এই ইন্টারফেস গুলোর যেকােন ইমপ্লিমেন্টেশন এটি ব্যবহার করতে পারবে।

```java
UserService userService = new UserService(
    new JdbcUserRepository(),
    new MD5PasswordEncryption()
);
```

শুধু যেখানে আমার UserService এর ইনস্ট্যান্স তৈরি করবো তার কনস্ট্রাক্টরে এই ইন্টারফেসগুলোর
ইমপ্লিমেন্টেশনের অবজেক্ট গুলো দিয়ে দেব তা হলেই হবে। এখন যদি আমাদের
Sha256PasswordEncryption প্রয়োজন হয়, তবে UserService-এর ইনস্ট্যান্স তৈরি করার
সময় আর্গুমেন্ট পরিবর্তন করলেই হয়ে যাবে।

```java
UserService userService = new UserService(
    new JdbcUserRepository(),
    new Sha256PasswordEncryption()
);
```

তাহলে এখানে ডিপেনডেন্সি সরবরাহ করার কন্ট্রোলটি ইনভার্ট হয়েছে। UserService-কে নিজে
থেকে ডিপেনডেন্সি তৈরি করতে হচ্ছে না। বরং এটি অন্য কেউ করছে। একেই বলা হয় ইনভার্শন
অব কন্ট্রোল (Inversion of Control)। এটি একটি সফটওয়্যার ইঞ্জিনিয়ারিং নীতি
(software engineering principle) যার ব্যবহার ব্যপক। প্রায় সমস্ত সফটওয়্যার framework এটি ব্যবহার করেই
(যেমন: Spring, .NET, Laravel, Django, Rails এত্যাদি)।
এটিই ছিল ইনভার্শন অব কন্ট্রোল নিয়ে আমার আলোচনা। অন্য কোন ব্লগে এর পরবর্তীতে বিষয়
ডিপেনডেন্সি ইনজেকশন নিয়ে আলোচনা করা হবে। সবাই করে ধন্যবাদ, খোদা হাফেজ।
