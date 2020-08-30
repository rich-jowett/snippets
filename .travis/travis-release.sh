#!/bin/bash
set -e

git config --global user.email "build@travis-ci.com"
git config --global user.name "Travis CI"

git remote add upstream git@github.com:rich-jowett/snippets.git

latest=$(git tag  -l --merged master --sort='-*authordate' | head -n1)
semver_parts=(${latest//./ })
major=${semver_parts[0]}
minor=${semver_parts[1]}
patch=${semver_parts[2]}

version=${major}.${minor}.$((patch + 1))

git tag ${version} -a -m "Tag during CI to $version"
git push upstream $TRAVIS_BRANCH --tags 2>&1
