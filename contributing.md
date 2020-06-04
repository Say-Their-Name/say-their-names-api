# Contributing

Contributions are **welcome** and will be fully **credited**.

Please read and understand the contribution guide before creating an issue or pull request.

## How to get started

Hey there! You're probably here because you want to help out. Thanks for joining us!

In this document we'll try to outline how to get started contributing to the API, and how to perform common tasks, like keeping your local fork up to date.

### Set up your own fork of the repository

In order to contribute you'll want to make a "fork" of this repository.

Click the `fork` button at https://github.com/Say-Their-Name/api and wait for it to complete.

Once the fork is done, clone your fork to your computer by navigating to a folder you'd like to put the site in, and then replacing `[username]` in this snippet with your GitHub username and running it from the terminal:

```bash
git clone git@github.com:[username]/api.git
```

In order to keep your fork up-to-date with the original repository, you'll also want to add an extra git "remote" that points to the original repo.

Your fork will already be connected to your local repo as the remote named `origin`.

Let's add your link to the original repo by running the following command after navigating to the `api` folder in your local repo:

```bash
git remote add upstream git@github.com:Say-Their-Name/api.git
```

This added a remote named `upstream` that points to The API's repo.

You can fetch the upstream branches by running the following command:

```
git fetch upstream --prune
```

Now you will need to follow the readme to get started

# How to perform common tasks

## Keep your fork up to date

Using the git remote we set up earlier, we first need to fetch changes that were made upstream:

```bash
git fetch upstream --prune
```

Next, change to your local master branch:

```bash
git checkout master
```

And merge the changes that were made upstream into your local branch.

```bash
git merge upstream/master --no-ff
```

## Prepare your pull request

Before actually creating a pull request, you have the chance to clean up your code. Remove debug statements, clean up commented code and refactor if needed.

Look to [this blog post](https://chris.beams.io/posts/git-commit/) for how to write a good git commit message.

## Create a pull request

When you have your changes ready in your own branch on your fork, it's time to create a pull request.
Try to describe what kind of changes you have made and why you have made them. This helps us in understanding why you are suggesting this change and what your reasoning behind it is.

Look to [this blog post](https://tighten.co/blog/building-a-great-pull-request/) for how to create a great pull request.

# How to contribute to this API

## Do you have content you can add?

* You can add an issue referencing the content you'd like to add. We have a data team that will need to validate all data

## Do you want to code on the app itself?

* Open or comment on an issue before starting to code to ensure someone else isn't already working on it and that you fully understand the goals and scope
* Once ready to code, fork the repo, and PR your changes in, referencing the original issue number
