**Create**
```cmd
vendor\bin\doctrine orm:generate-entities src --generate-annotations=true
vendor\bin\doctrine orm:schema-tool:create
```

**Update**
```cmd
vendor\bin\doctrine orm:generate-entities src --regenerate-entities=true --generate-annotations=true
vendor\bin\doctrine orm:schema-tool:update --force --dump-sql --complete
```

**Validate**
```cmd
vendor\bin\doctrine orm:validate-schema
```

**Repository**
```cmd
vendor\bin\doctrine orm:generate-repositories --filter="\\Car$" src
```